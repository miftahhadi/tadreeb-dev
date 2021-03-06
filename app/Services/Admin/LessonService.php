<?php

namespace App\Services\Admin;

use App\Models\Lesson;

class LessonService
{
    public function createLesson($data)
    {
        return auth()->user()->lessons()->create($data);
    }

    public function update($data, Lesson $pelajaran)
    {

        return $pelajaran->update([
                    'judul' => $data['judul'],
                    'slug' => $data['slug'],
                    'deskripsi' => $data['deskripsi']
                ]);
    }

    public function destroy(Lesson $pelajaran)
    {
        // Hapus section dan isinya

        // Hapus pelajaran
        return $pelajaran->delete();
    }
}