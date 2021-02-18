<template>
<v-container fluid>
<v-card class="mx-auto yellow lighten-3" >
<v-row no-gutters>
	<v-col class="d-flex" cols="12" sm="6">
	<v-list-item>
	  <v-list-item-content>
	    <v-list-item-title>Ukuran Font</v-list-item-title>
	    <v-list-item-subtitle>
		    <v-col class="d-flex" cols="12">
		        <v-text-field label="px" type="number" @change="updatepos1('1')" v-model="form.groupid1" outlined dense ></v-text-field>
		      </v-col>
	    </v-list-item-subtitle>
	  </v-list-item-content>
	</v-list-item>
	</v-col>
    <v-col class="d-flex" cols="12" sm="6">
    <v-list-item>
      <v-list-item-content>
        <v-list-item-title>Posisi No.Uji Naik Turun </v-list-item-title>
        <v-list-item-subtitle>
            <v-col class="d-flex" cols="12">
                <v-text-field label="px" type="number" @change="updatepos2('2')" v-model="form.groupid2" outlined dense ></v-text-field>
              </v-col>
        </v-list-item-subtitle>
      </v-list-item-content>
    </v-list-item>
    </v-col>
    <v-col class="d-flex" cols="12" sm="6">
    <v-list-item>
      <v-list-item-content>
        <v-list-item-title>Posisi No.Kendaraan Naik Turun </v-list-item-title>
        <v-list-item-subtitle>
            <v-col class="d-flex" cols="12">
                <v-text-field label="px" type="number" @change="updatepos3('3')" v-model="form.groupid3" outlined dense ></v-text-field>
              </v-col>
        </v-list-item-subtitle>
      </v-list-item-content>
    </v-list-item>
    </v-col>
    <v-col class="d-flex" cols="12" sm="6">
    <v-list-item>
      <v-list-item-content>
        <v-list-item-title>Posisi Data Kendaraan Naik Turun </v-list-item-title>
        <v-list-item-subtitle>
            <v-col class="d-flex" cols="12">
                <v-text-field label="px" type="number" @change="updatepos4('4')" v-model="form.groupid4" outlined dense ></v-text-field>
              </v-col>
        </v-list-item-subtitle>
      </v-list-item-content>
    </v-list-item>
    </v-col>
    <v-col class="d-flex" cols="12" sm="6">
    <v-list-item>
      <v-list-item-content>
        <v-list-item-title>Posisi Data Spesifikasi Naik Turun </v-list-item-title>
        <v-list-item-subtitle>
            <v-col class="d-flex" cols="12">
                <v-text-field label="cm" type="number" @change="updatepos5('5')" v-model="form.groupid5" outlined dense ></v-text-field>
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
        fetchPost() {
            axios({
                    url: '/api/settingamprah/',
                    method: "get"
                })
                .then((result) => {
                    this.itemuji= result.data.items
                    this.form.groupid1=result.data.items[0]
                    this.form.groupid2=result.data.items[1]
                    this.form.groupid3=result.data.items[2]
                    this.form.groupid4=result.data.items[3]
                    this.form.groupid5=result.data.items[4]
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
            this.form.patch('/api/setpamprah/edit/' + id)
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
                    url: '/api/setpamprah/edit/'+id,
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
                    url: '/api/setpamprah/edit/'+id,
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
                    url: '/api/setpamprah/edit/'+id,
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
                    url: '/api/setpamprah/edit/'+id,
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
                    url: '/api/setpamprah/edit/'+id,
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
                    url: '/api/setpamprah/edit/'+id,
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
                    url: '/api/setpamprah/edit/'+id,
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
                    url: '/api/setpamprah/edit/'+id,
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
                    url: '/api/setpamprah/edit/'+id,
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
                    url: '/api/setpamprah/edit/'+id,
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
                    url: '/api/setpamprah/edit/'+id,
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