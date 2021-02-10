<template>
<v-container fluid>
<v-card class="mx-auto yellow lighten-3" >
<v-row no-gutters>
	<v-col class="d-flex" cols="12" sm="6">
	<v-list-item>
	  <v-list-item-content>
	    <v-list-item-title>PEMERIKSAAN VISUAL KENDARAAN</v-list-item-title>
	    <v-list-item-subtitle>
		    <v-col class="d-flex" cols="12">
		        <v-text-field label="POS" type="number" @change="updatepos1('1')" v-model="form.groupid1" max="2" min="1" outlined dense ></v-text-field>
		      </v-col>
	    </v-list-item-subtitle>
	  </v-list-item-content>
	</v-list-item>
	</v-col>
    <v-col class="d-flex" cols="12" sm="6">
    <v-list-item>
      <v-list-item-content>
        <v-list-item-title>PEMERIKSAAN MANUAL KENDARAAN</v-list-item-title>
        <v-list-item-subtitle>
            <v-col class="d-flex" cols="12">
                <v-text-field label="POS" type="number" @change="updatepos2('2')" v-model="form.groupid2" max="2" min="1" outlined dense ></v-text-field>
              </v-col>
        </v-list-item-subtitle>
      </v-list-item-content>
    </v-list-item>
    </v-col>
    <v-col class="d-flex" cols="12" sm="6">
    <v-list-item>
      <v-list-item-content>
        <v-list-item-title>EMISI GAS BUANG</v-list-item-title>
        <v-list-item-subtitle>
            <v-col class="d-flex" cols="12">
                <v-text-field label="POS" type="number" @change="updatepos2('3')" v-model="form.groupid3" max="2" min="1" outlined dense ></v-text-field>
              </v-col>
        </v-list-item-subtitle>
      </v-list-item-content>
    </v-list-item>
    </v-col>
    <v-col class="d-flex" cols="12" sm="6">
    <v-list-item>
      <v-list-item-content>
        <v-list-item-title>TINGKAT SUARA KLAKSON</v-list-item-title>
        <v-list-item-subtitle>
            <v-col class="d-flex" cols="12">
                <v-text-field label="POS" type="number" @change="updatepos4('4')" v-model="form.groupid4" max="2" min="1" outlined dense ></v-text-field>
              </v-col>
        </v-list-item-subtitle>
      </v-list-item-content>
    </v-list-item>
    </v-col>
    <v-col class="d-flex" cols="12" sm="6">
    <v-list-item>
      <v-list-item-content>
        <v-list-item-title>BERAT SUMBU</v-list-item-title>
        <v-list-item-subtitle>
            <v-col class="d-flex" cols="12">
                <v-text-field label="POS" type="number" @change="updatepos5('5')" v-model="form.groupid5" max="2" min="1" outlined dense ></v-text-field>
              </v-col>
        </v-list-item-subtitle>
      </v-list-item-content>
    </v-list-item>
    </v-col>
    <v-col class="d-flex" cols="12" sm="6">
    <v-list-item>
      <v-list-item-content>
        <v-list-item-title>KEMAMPUAN REM UTAMA</v-list-item-title>
        <v-list-item-subtitle>
            <v-col class="d-flex" cols="12">
                <v-text-field label="POS" type="number" @change="updatepos6('6')" v-model="form.groupid6" max="2" min="1" outlined dense ></v-text-field>
              </v-col>
        </v-list-item-subtitle>
      </v-list-item-content>
    </v-list-item>
    </v-col>
    <v-col class="d-flex" cols="12" sm="6">
    <v-list-item>
      <v-list-item-content>
        <v-list-item-title>KEMAMPUAN REM PARKIR</v-list-item-title>
        <v-list-item-subtitle>
            <v-col class="d-flex" cols="12">
                <v-text-field label="POS" type="number" @change="updatepos7('7')" v-model="form.groupid7" max="2" min="1" outlined dense ></v-text-field>
              </v-col>
        </v-list-item-subtitle>
      </v-list-item-content>
    </v-list-item>
    </v-col>
    <v-col class="d-flex" cols="12" sm="6">
    <v-list-item>
      <v-list-item-content>
        <v-list-item-title>KINCUP RODA DEPAN</v-list-item-title>
        <v-list-item-subtitle>
            <v-col class="d-flex" cols="12">
                <v-text-field label="POS" type="number" @change="updatepos8('8')" v-model="form.groupid8" max="2" min="1" outlined dense ></v-text-field>
              </v-col>
        </v-list-item-subtitle>
      </v-list-item-content>
    </v-list-item>
    </v-col>
    <v-col class="d-flex" cols="12" sm="6">
    <v-list-item>
      <v-list-item-content>
        <v-list-item-title>KEMAMPUAN PANCAR dan ARAH SINAR LAMPU UTAMA</v-list-item-title>
        <v-list-item-subtitle>
            <v-col class="d-flex" cols="12">
                <v-text-field label="POS" type="number" @change="updatepos9('9')" v-model="form.groupid9" max="2" min="1" outlined dense ></v-text-field>
              </v-col>
        </v-list-item-subtitle>
      </v-list-item-content>
    </v-list-item>
    </v-col>
    <v-col class="d-flex" cols="12" sm="6">
    <v-list-item>
      <v-list-item-content>
        <v-list-item-title>AKURASI PENUNJUK KECEPATAN/SPEEDOMETER</v-list-item-title>
        <v-list-item-subtitle>
            <v-col class="d-flex" cols="12">
                <v-text-field label="POS" type="number" @change="updatepos10('10')" v-model="form.groupid10" max="2" min="1" outlined dense ></v-text-field>
              </v-col>
        </v-list-item-subtitle>
      </v-list-item-content>
    </v-list-item>
    </v-col>
    <v-col class="d-flex" cols="12" sm="6">
    <v-list-item>
      <v-list-item-content>
        <v-list-item-title>KEDALAMAN ALUR BAN</v-list-item-title>
        <v-list-item-subtitle>
            <v-col class="d-flex" cols="12">
                <v-text-field label="POS" type="number" @change="updatepos11('11')" v-model="form.groupid11" max="2" min="1" outlined dense ></v-text-field>
              </v-col>
        </v-list-item-subtitle>
      </v-list-item-content>
    </v-list-item>
    </v-col>
</v-row>
</v-card>
</v-card>
</v-container>
</template>

<script>
export default {
    data() {
        return ({
            itemuji: [],
      		groupuji: [],
            form: new Form({
                groupid1: '',
                groupid2: '',
                groupid3: '',
                groupid4: '',
                groupid5: '',
                groupid6: '',
                groupid7: '',
                groupid8: '',
                groupid9: '',
                groupid10: '',
                groupid11: '',
            })
        })
    },
    methods: {
        savePost() {
            this.form.post('/api/post/new')
                .then((result) => {
                    Swal.fire({
                        type: 'success',
                        title: 'saved',
                        showConfirmButton: false,
                        timer: 500,
                    })
                    this.$router.push('/admin/posts')
                }).catch((err) => {
                    Swal.fire({
                        type: 'error',
                        title: 'Ooops',
                        text: err
                    })
                });
        },
        fetchPost() {
            axios({
                    url: '/api/itemuji/',
                    method: "get"
                })
                .then((result) => {
                    this.itemuji= result.data.items
                    this.form.groupid1=result.data.items[0].groupuji_id
                    this.form.groupid2=result.data.items[1].groupuji_id
                    this.form.groupid3=result.data.items[2].groupuji_id
                    this.form.groupid4=result.data.items[3].groupuji_id
                    this.form.groupid5=result.data.items[4].groupuji_id
                    this.form.groupid6=result.data.items[5].groupuji_id
                    this.form.groupid7=result.data.items[6].groupuji_id
                    this.form.groupid8=result.data.items[7].groupuji_id
                    this.form.groupid9=result.data.items[8].groupuji_id
                    this.form.groupid10=result.data.items[9].groupuji_id
                    this.form.groupid11=result.data.items[10].groupuji_id
                }).catch((err) => {

                });
            axios({
                    url: '/api/groupuji/',
                    method: "get"
                })
                .then((result) => {
                    this.groupuji= result.data.items
                    console.log(this.groupuji)
                }).catch((err) => {

                });
        },
        editPost(id) {
            this.form.patch('/api/setposuji/edit/' + id)
                .then((result) => {
                    Swal.fire({
                        type: 'success',
                        title: 'saved',
                        showConfirmButton: false,
                        timer: 500,
                    })
                   this.$router.push('/admin/posts')
                }).catch((err) => {
                    Swal.fire({
                        type: 'error',
                        title: 'Ooops',
                        text: err
                    })
                });
        },
        updatepos1(id) {
            axios({
                    url: '/api/setposuji/edit/'+id,
                    method: "post",
                    data: {
                    groupuji_id: this.form.groupid1,
                  }
                })
                .then((result) => {
                    Swal.fire({
                        type: 'success',
                        title: 'saved',
                        showConfirmButton: false,
                        timer: 500,
                    })
                }).catch((err) => {

                });
        },
        updatepos2(id) {
            axios({
                    url: '/api/setposuji/edit/'+id,
                    method: "post",
                    data: {
                    groupuji_id: this.form.groupid2,
                  }
                })
                .then((result) => {
                    Swal.fire({
                        type: 'success',
                        title: 'saved',
                        showConfirmButton: false,
                        timer: 500,
                    })
                }).catch((err) => {

                });
        },
        updatepos3(id) {
            axios({
                    url: '/api/setposuji/edit/'+id,
                    method: "post",
                    data: {
                    groupuji_id: this.form.groupid3,
                  }
                })
                .then((result) => {
                    Swal.fire({
                        type: 'success',
                        title: 'saved',
                        showConfirmButton: false,
                        timer: 500,
                    })
                }).catch((err) => {

                });
        },
        updatepos4(id) {
            axios({
                    url: '/api/setposuji/edit/'+id,
                    method: "post",
                    data: {
                    groupuji_id: this.form.groupid4,
                  }
                })
                .then((result) => {
                    Swal.fire({
                        type: 'success',
                        title: 'saved',
                        showConfirmButton: false,
                        timer: 500,
                    })
                }).catch((err) => {

                });
        },
        updatepos5(id) {
            axios({
                    url: '/api/setposuji/edit/'+id,
                    method: "post",
                    data: {
                    groupuji_id: this.form.groupid5,
                  }
                })
                .then((result) => {
                    Swal.fire({
                        type: 'success',
                        title: 'saved',
                        showConfirmButton: false,
                        timer: 500,
                    })
                }).catch((err) => {

                });
        },
        updatepos6(id) {
            axios({
                    url: '/api/setposuji/edit/'+id,
                    method: "post",
                    data: {
                    groupuji_id: this.form.groupid6,
                  }
                })
                .then((result) => {
                    Swal.fire({
                        type: 'success',
                        title: 'saved',
                        showConfirmButton: false,
                        timer: 500,
                    })
                }).catch((err) => {

                });
        },
        updatepos7(id) {
            axios({
                    url: '/api/setposuji/edit/'+id,
                    method: "post",
                    data: {
                    groupuji_id: this.form.groupid7,
                  }
                })
                .then((result) => {
                    Swal.fire({
                        type: 'success',
                        title: 'saved',
                        showConfirmButton: false,
                        timer: 500,
                    })
                }).catch((err) => {

                });
        },
        updatepos8(id) {
            axios({
                    url: '/api/setposuji/edit/'+id,
                    method: "post",
                    data: {
                    groupuji_id: this.form.groupid8,
                  }
                })
                .then((result) => {
                    Swal.fire({
                        type: 'success',
                        title: 'saved',
                        showConfirmButton: false,
                        timer: 500,
                    })
                }).catch((err) => {

                });
        },
        updatepos9(id) {
            axios({
                    url: '/api/setposuji/edit/'+id,
                    method: "post",
                    data: {
                    groupuji_id: this.form.groupid9,
                  }
                })
                .then((result) => {
                    Swal.fire({
                        type: 'success',
                        title: 'saved',
                        showConfirmButton: false,
                        timer: 500,
                    })
                }).catch((err) => {

                });
        },
        updatepos10(id) {
            axios({
                    url: '/api/setposuji/edit/'+id,
                    method: "post",
                    data: {
                    groupuji_id: this.form.groupid10,
                  }
                })
                .then((result) => {
                    Swal.fire({
                        type: 'success',
                        title: 'saved',
                        showConfirmButton: false,
                        timer: 500,
                    })
                }).catch((err) => {

                });
        },
        updatepos11(id) {
            axios({
                    url: '/api/setposuji/edit/'+id,
                    method: "post",
                    data: {
                    groupuji_id: this.form.groupid11,
                  }
                })
                .then((result) => {
                    Swal.fire({
                        type: 'success',
                        title: 'saved',
                        showConfirmButton: false,
                        timer: 500,
                    })
                }).catch((err) => {

                });
        },
    },
    mounted() {
        this.fetchPost()
    }
}
</script>