<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Minute;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MinuteController extends Controller
{
    public function index(Request $request)
    {
        // Validasi Search Form
        $validated = $request->validate([
            'status' => 'nullable|string|in:Arsip,Terbit,all',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'search' => 'nullable|string|max:50',
        ]);

        // Ambil Nilai
        $status = $validated['status'] ?? 'all';
        $start_date = $validated['start_date'] ?? null;
        $end_date = $validated['end_date'] ?? null;
        $search = $validated['search'] ?? null;

        // Semua Notulen
        $minutes = Minute::with('user')
            ->when($search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('problem', 'LIKE', "%{$search}%")
                        ->orWhereHas('user', function ($query) use ($search) {
                            $query->where('name', 'LIKE', "%{$search}%");
                        });
                });
            })
            ->when($start_date, function ($query) use ($start_date) {
                return $query->whereDate('follow_up_limits', '>=', $start_date);
            })
            ->when($end_date, function ($query) use ($end_date) {
                return $query->whereDate('follow_up_limits', '<=', $end_date);
            })
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        // Judul Halaman
        $title = "Notulen";

        return view('minute.index', compact('title', 'minutes', 'start_date', 'end_date', 'search'));
    }

    public function create()
    {
        // Judul Halaman
        $title = "Tambah Notulen";

        // Ambil Data Pengguna
        $users = User::all();

        return view('minute.create', compact('title', 'users'));
    }

    public function store(Request $request)
    {
        // Validasi Input
        $validated = $request->validate([
            'problem' => 'required|string|max:10000',
            'solution' => 'required|string|max:10000',
            'user_id' => 'required|numeric',
            'follow_up_plan' => 'required|string|max:10000',
            'follow_up_limits' => 'required|date',
            'data_source' => 'required|string|max:10000',
            'evidence' => 'required|image|max:3072|mimes:jpg,jpeg,png',
        ]);

        // Simpan Gambar
        if ($request->hasFile('evidence')) {
            $filePath = $request->file('evidence')->store('minutes', 'public');
            $validated['evidence'] = $filePath;
        }

        // Simpan Notulen
        $validated['followed_up_by'] = $request['user_id'];
        Minute::create($validated);

        return redirect()->route('dashboard.minute.index')
            ->with('success', 'Notulen berhasil ditambahkan.');
    }

    public function printPDF(string $id)
    {
        // Ambil data laporan berdasarkan nomor tiket
        $minute = Minute::with('user')->findOrFail($id);

        // Generate PDF menggunakan view
        $pdf = Pdf::loadView('minute.pdf', compact('minute'));

        // Mengunduh PDF
        return $pdf->stream("Notulen.pdf");
    }

    public function edit(string $id)
    {
        // Ambil Data Berdasarkan ID
        $minute = Minute::findOrFail($id);

        // Ambil Data Pengguna
        $users = User::all();

        // Judul Halaman
        $title = "Notulen: " . $minute->id;

        return view('minute.edit', compact('title', 'minute', 'users'));
    }

    public function update(Request $request, string $id)
    {
        // Validasi Input
        $validated = $request->validate([
            'problem' => 'required|string|max:10000',
            'solution' => 'required|string|max:10000',
            'user_id' => 'required|numeric',
            'follow_up_plan' => 'required|string|max:10000',
            'follow_up_limits' => 'required|date',
            'data_source' => 'required|string|max:10000',
            'evidence' => 'nullable|image|max:3072|mimes:jpg,jpeg,png',
        ]);

        $minute = Minute::findOrFail($id);

        // Jika ada file baru, simpan dan hapus yang lama
        if ($request->hasFile('evidence')) {
            // Hapus file lama jika ada
            if ($minute->evidence && Storage::disk('public')->exists($minute->evidence)) {
                Storage::disk('public')->delete($minute->evidence);
            }

            // Simpan file baru
            $filePath = $request->file('evidence')->store('minutes', 'public');
            $validated['evidence'] = $filePath;
        }

        // Update data
        $validated['followed_up_by'] = $request['user_id'];
        $minute->update($validated);

        return redirect()->route('dashboard.minute.index')
            ->with('success', 'Notulen berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        // Ambil Data Berdasarkan ID
        $minute = Minute::findOrFail($id);

        // Hapus Gambar
        if ($minute->evidence) {
            Storage::disk('public')->delete($minute->evidence);
        }

        // Hapus Notulen
        $minute->delete();

        return redirect()->route('dashboard.minute.index')
            ->with('success', 'Notulen berhasil dihapus.');
    }
}
