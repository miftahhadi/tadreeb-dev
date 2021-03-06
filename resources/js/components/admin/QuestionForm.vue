<template>
    <div>        
        <slot name="csrf"></slot>

        <div class="card mb-3">
            <div class="card-header">
                <div class="col-auto">
                    <span class="card-title">
                        Buat soal baru
                    </span>
                </div>

                <div class="col-auto ml-auto">
                    <button class="btn btn-success" :class="saving" @click="save()">Simpan</button>
                    <a :href="backUrl" class="btn btn-white">Kembali</a>
                </div>

            </div>
            <div class="card-body form-group row">
                <div class="col-md-4 col-lg-4 col-xl-4 row">
                    <label class="form-label col-auto col-lg-4 col-form-label">Tipe soal:</label>
                    <div class="col-auto col-lg-8">
                        <select class="form-select" v-model="question.tipe" name="tipe" @change="changeQuestionType()">
                            <option v-for="opsi in typeOptions" :key="opsi.id" :value="opsi.value">{{ opsi.text }}</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-4 col-lg-5 col-xl-5 row">
                    <label class="form-label col-auto col-lg-5 col-form-label">Kode soal (opsional):</label>
                    <div class="col-auto col-lg-7">
                        <input type="text" class="form-control" v-model="question.kode" placeholder="misal: nhw21a" name="kode">
                    </div>
                </div>

                <div class="col-md-4 col-lg-3 col-xl-3 row">
                    <label class="form-label col-auto col-lg-4 col-form-label">ID soal:</label>
                    <div class="col-auto col-lg-8">
                        <input type="text" class="form-control" v-model="question.id" name="kode" disabled>
                    </div>
                </div>

            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Redaksi Soal
            </div>
            <div class="card-body">
        
                <small class="text-danger mb-2" v-show="errors.question">{{ errors.question }}</small>
        
                <ckeditor v-model="question.konten" :editor-url="editorUrl" name="redaksiSoal"></ckeditor>

            </div>
        </div>

        <hr>

        <h3>Pilihan Jawaban</h3>

        <div class="card mb-4" v-for="(i,index) in answersNum" :key="index">
            <div class="card-header">
                <div class="col-auto">
                    Pilihan {{ i }}
                </div>
                <div class="col-auto ml-auto">
                    <button 
                        class="btn btn-sm text-danger" 
                        data-toggle="modal"
                        data-target="#deleteAnswerModal"
                        @click="callDeleteAnswer(index)"
                    >Hapus</button>
                </div>
            </div>

            <div class="card-body">
                <small class="text-danger mb-2" v-show="errors.answers[index]">{{ errors.answers[index] }}</small>

                <ckeditor 
                    v-model="answers[index].redaksi" 
                    :editor-url="editorUrl" 
                    :name="'jawaban[' + index + '][benar]'"
                    @input="isAnswerEmpty(index)"
                ></ckeditor>
            </div> 
            
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <div class="form-label">Pilihan Benar</div>
                            <label class="form-check">
                                <input :type="inputType" class="form-check-input" :name="'jawaban[' + index + '][benar]'" :value="index" v-model="jawabanBenar">
                                <span class="form-check-label">Benar</span>
                            </label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Nilai</label>

                            <input 
                                type="number" 
                                class="form-control" 
                                name="jawaban[][nilai]" 
                                placeholder="Nilai" 
                                value="0"
                                v-model="answers[index].nilai"
                            >

                        </div>
                    </div>  

                </div>
            </div>

        </div>

        <button class="btn btn-square" @click="addAnswer()">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="4" width="16" height="16" rx="2" /><line x1="9" y1="12" x2="15" y2="12" /><line x1="12" y1="9" x2="12" y2="15" /></svg>
            Tambah jawaban
        </button>

        <modal
            id="deleteAnswerModal"
            :classes="['modal-dialog-centered']"
        >
            <template #header>
                Hapus jawaban
            </template>

            <template #body>
                Apakah Anda yakin menghapus jawaban ini?
            </template>

            <template #footer>
                <button type="button" class="btn btn-link link-secondary mr-auto" data-dismiss="modal">Batal</button>
                
                <button 
                    type="button" 
                    class="btn btn-danger" 
                    data-dismiss="modal"
                    @click="deleteAnswer()"
                >Ya, hapus</button>
            </template>

        </modal>

    </div>
</template>

<script>
import swal from "sweetalert";

export default {
    name: 'question-form',

    props: {
        examId: Number,
        questionModel: Object,
    },

    data() {
        return {
            question: {
                id: null,
                kode: null,
                tipe: 'pilihan-ganda',
                konten: null
            },
            editorUrl: '/dist/vendor/ckeditor/ckeditor.js',

            saveLoading: false,

            typeOptions: [
                {
                    text: 'Pilihan Ganda',
                    value: 'pilihan-ganda'
                },
                
                {
                    text: 'Jawaban Ganda',
                    value: 'jawaban-ganda'
                },

                {
                    text: 'Benar-Salah',
                    value: 'benar-salah'
                },

                {
                    text: 'Benar-Salah (Arabic)',
                    value: 'benar-salah-arabic'
                },
            ],

            benarSalahOptions: {
                reguler: {
                    benar: 'Benar',
                    salah: 'Salah'
                },

                arabic: {
                    benar: 'صحيح',
                    salah: 'خطأ'
                }
            },

            answersNum: 2,

            answers: [
                {
                    redaksi: '',
                    nilai: 0
                },
                {
                    redaksi: '',
                    nilai: 0
                }
            ],

            answerToDelete: null,

            jawabanBenar: null,

            errors: {
                question: null,
                answers: [],
            }

        }
    },

    watch: {
        'question.konten': function (newKonten, oldKonten) {
            if (newKonten != '') {
                this.errors.question = ''
            }
        }
    },

    methods: {
        addAnswer() {
            this.answersNum += 1;

            const answer = {
                redaksi: '',
                nilai: 0
            }

            this.answers.push(answer)
        },

        callDeleteAnswer(index) {
            this.answerToDelete = index
        },

        deleteAnswer() {
            const index = this.answerToDelete

            if (this.answers[index].hasOwnProperty('id')) {
                axios.delete('/api/soal/' + this.question.id + '/jawaban/' + this.answers[index].id) 
            }
            this.answersNum -= 1

            this.answers.splice(index, 1)
            
            if (this.question.tipe == 'jawaban-ganda' && this.jawabanBenar.includes(index)) {
                this.jawabanBenar.splice(index,1)
            } else if (this.question.tipe != 'jawaban-ganda' && this.jawabanBenar == index) {
                this.jawabanBenar = null
            }

            this.answerToDelete = null
            swal("Berhasil!", "Jawaban berhasil dihapus", "success")

        },

        validate() {
            let errors = 0

            if (this.question.konten == '') {
                this.errors.question = 'Soal tidak boleh kosong'

                errors += 1
            }

            let i = 0;
            this.errors.answers[i] = null

            for (i; i < this.answers.length; i++) {
                if (this.answers[i].redaksi == '') {
                    this.errors.answers[i] = 'Redaksi jawaban tidak boleh kosong'

                    errors += 1;
                }                
            }

            return errors
        },

        save() {
            this.saveLoading = true 

            const errors = this.validate()

            if (errors > 0) {
                this.saveLoading = false

                swal("Terjadi kesalahan!", "Mohon periksa data yang Anda masukkan, pastikan redaksi soal dan jawaban tidak ada yang kosong", "error")
                return 
            }

            for (let i = 0; i < this.answers.length; i++) {
                let checkFirst = this.question.tipe == 'jawaban-ganda' && this.jawabanBenar.includes(i)
                let checkSecond = this.question.tipe != 'jawaban-ganda' && this.jawabanBenar == i

                if (checkFirst || checkSecond) {
                    this.answers[i].benar = 1
                } else {
                    this.answers[i].benar = 0
                }
            }

            let question = this.question;

            switch (question.tipe) {
                case 'pilihan-ganda':
                    question.tipe = 'Pilihan Ganda';
                    break;

                case 'jawaban-ganda':
                    question.tipe = 'Jawaban Ganda';
                    break;
                
                case 'benar-salah':
                case 'benar-salah-arabic':
                    question.tipe = 'Benar/Salah';
                    break;
            }

            const axiosConfig = {
                url: (this.question.id != null) ? '/api/soal/' + this.question.id : '/api/soal',

                method: (this.question.id != null) ? 'put' : 'post',

                data: {
                        examId: this.examId,
                        question: question,
                        answers: this.answers
                    }
            }

            axios(axiosConfig).then(response => {
                swal("Data berhasil disimpan!", "Anda bisa kembali ke halaman sebelumnya atau tetap di sini untuk mengedit soal", "success")

                this.saveLoading = false
                // console.log(response.data)
                this.processData(response.data)
            }).catch(errors => {
                console.log(errors)
            })
           
        },

        processData(question) {
            this.question = question;
            const types = {
                'Pilihan Ganda': 'pilihan-ganda',
                'Jawaban Ganda': 'jawaban-ganda',
                'Benar/Salah': 'benar-salah'
            }
            
            this.question.tipe = types[question.tipe];

            this.answers = question.answers

            this.answersNum = question.answers.length

            for (let i = 0; i < question.answers.length; i++) {
                if (question.answers[i].benar == 1 && this.question.tipe == 'jawaban-ganda') {
                    this.jawabanBenar.push(i);
                } else if (question.answers[i].benar == 1 && this.question.tipe != 'jawaban-ganda') {
                    this.jawabanBenar = i;
                }
            }

        },

        isAnswerEmpty(index) {
            if (this.answers[index] != '') {
                this.errors.answers[index] = ''
            }
        },

        changeQuestionType() {
            if (this.question.tipe == 'benar-salah') {
                this.answersNum = 2

                this.answers = [
                    {
                        redaksi: this.benarSalahOptions.reguler.benar,
                        nilai: 0
                    },
                    {
                        redaksi: this.benarSalahOptions.reguler.salah,
                        nilai: 0
                    }
                ]
            } else if (this.question.tipe == 'benar-salah-arabic') {
                this.answersNum = 2

                this.answers = [
                        {
                            redaksi: '<span dir="rtl" lang="ar" style="font-family:Scheherazade;font-size:24px">' + this.benarSalahOptions.arabic.benar + '</span>',
                            nilai: 0
                        },
                        {
                            redaksi: '<span dir="rtl" lang="ar" style="font-family:Scheherazade;font-size:24px">' + this.benarSalahOptions.arabic.salah + '</span>',
                            nilai: 0
                        }
                    ]   
            }
            
            if (this.question.tipe == 'jawaban-ganda') {
                this.jawabanBenar = [];
            } else {
                this.jawabanBenar = null
            }
        }
    },

    computed: {
        inputType() {
            return (this.question.tipe == 'jawaban-ganda') ? 'checkbox' : 'radio'
        },

        backUrl() {
            return (this.examId != null) ? '/admin/ujian/' + this.examId : '/admin/soal'
        },

        questionIsEmpty() {
            return this.question.konten == ''
        },

        saving() {
            return (this.saveLoading) ? 'btn-loading' : ''
        }
    },

    mounted() {
        if (this.questionModel != null) {
            this.processData(this.questionModel)
        }

        for (let i = 0; i < this.answersNum; i++) {
            this.errors.answers[i] = null;
        }
    }
}
</script>