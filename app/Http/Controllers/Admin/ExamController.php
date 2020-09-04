<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\ExamService;
use App\Http\Requests\Admin\StoreExamRequest;
use App\Exam;


class ExamController extends Controller
{

    protected $examService;

    public function __construct(ExamService $examService)
    {
        $this->examService = $examService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.exam.index', [
            'exams' => Exam::all(),
            'item' => 'ujian',
            'judul' => 'Judul Ujian',
            'slug' => 'exam URL',
            'url' => $_SERVER['SERVER_NAME'] . '/k/{kelas}/u',
            'action' => '/admin/ujian'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExamRequest $request)
    {
        $exam = $this->examService->createExam($request->validated());

        return redirect(route('ujian.show', ['exam' => $exam->exam]));
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $ujian
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $ujian)
    {

        return view('admin.exam.show', [
            'ujian' => $ujian,
            'questionTypes' => $this->examService->questionTypes,
            'answerIcons' => $this->examService->answerIcons
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $ujian
     * @return \Illuminate\Http\Response
     */
    public function edit($ujian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $ujian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $ujian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $ujian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $ujian)
    {
        $ujian->delete();

        return redirect(route('ujian.index'));
    }
}
