<template>
<v-container fluid >
    <v-btn bottom color="blue" dark fab fixed right @click="dialog = !dialog">
        <v-icon>mdi-plus</v-icon>
    </v-btn>
  <form>
  <v-row dense>
    <v-col cols="12">
    <v-card class="yellow lighten-3">
      <v-card-title>
        <span class="headline">Management User</span>
      </v-card-title>
      <v-card-text>
        <v-container>
        <v-row>
          <v-col cols="12" sm="4">
            <v-text-field v-model="form.name" label="Name" required></v-text-field>
          </v-col>
          <v-col cols="12" sm="4">
            <v-text-field v-model="form.username" label="Username" required></v-text-field>
          </v-col>
          <v-col cols="12" sm="4">
            <v-select 
            :items="level" label="Level*" v-model="form.level" required >
            </v-select>
          </v-col>
        </v-row>
        </v-container>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="blue darken-1" text  @click="goBack">Cancel</v-btn>
        <v-btn v-if="this.$route.params.id" outlined @click="editPost($route.params.id)" color="success">save</v-btn>
            <v-btn v-else outlined type="submit" color="success">save</v-btn>
      </v-card-actions>
    </v-card>
    </v-col>

    <v-col cols="12">
    <v-card class="yellow lighten-3">
      <v-card-title>
        <span class="headline">Management Halaman</span>
      </v-card-title>
      <v-card-text>
        <v-container>
        <v-simple-table fixed-header height="300px" class="yellow lighten-3">
          <template v-slot:default>
            <thead>
              <tr>
                <th class="text-left">Name</th>
                <th class="text-left">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item in halamanakses" :key="item.halaman">
                <td>{{ item.halaman }}</td>
                <td>
                    <v-btn class="v-btn-simple" color="error" icon v-on="on" @click="deletehalaman(item.id,item.user_id)">
                        <v-icon>mdi-trash-can</v-icon>
                    </v-btn>
                </td>
              </tr>
            </tbody>
          </template>
        </v-simple-table>
        </v-container>
      </v-card-text>
    </v-card>
    </v-col>
  </v-row>
  </form>

  <v-dialog v-model="dialog" width="500px" >
        <form @submit.prevent="saveHalaman($route.params.id)">
          <v-card>
            <v-card-title class="grey darken-2">
              Add Halaman
            </v-card-title>
            <v-container>
              <v-row class="mx-2">
                <v-col cols="12" sm="12">
                    <v-select 
                    :items="halaman" label="Halaman" item-text="halaman" item-value="id" v-model="formhal.halaman" required >
                    </v-select>
              </v-col>
              </v-row>
            </v-container>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn text color="primary" @click="dialog = false" >Cancel</v-btn>
              <v-btn text type="submit">Save</v-btn>
            </v-card-actions>
          </v-card>
        </form>
        </v-dialog>
</v-container>
</template>
<script>
export default {
    data() {
        return {
            level : ['Pendaftaran', 'Retribusi', 'Cetak', 'Penguji'],
            dialog: false,
            halamanakses: [],
            halaman: [],
            form: new Form({
                name: '',
                username: '',
                level: '',
            }),

            formhal: new Form({
                halaman: '',
            })

        }
    },
    methods: {
        goBack() {
              window.history.length > 1 ? this.$router.go(-1) : this.$router.push('/')
            },
        savePost() {
            this.form.post('/api/user/new')
                .then((result) => {
                    Swal.fire({
                        type: 'success',
                        title: 'saved',
                        showConfirmButton: false,
                        timer: 500,
                    })
                    this.dialog = false
                    this.$router.push('/admin/managementuser')
                }).catch((err) => {
                    Swal.fire({
                        type: 'error',
                        title: 'Ooops',
                        text: err
                    })
                });
        },deletehalaman(id,id_user) {
            Swal.fire({
                title: 'Anda yakin hapus halaman ini?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then((result) => {
                if (result.value) {
                    this.form.delete('/api/delhalaman/' + id+'/'+id_user)
                     Fire.$emit('afterCreate')
                        Swal.fire(
                            'Deleted!',
                            'success'
                        )
                    this.initialize();
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    Swal.fire(
                        'Cancelled',
                        'Data masih tersimpan)',
                        'error'
                    )
                }
            })
        },
        saveHalaman(id) {
            this.formhal.post('/api/addhalaman/'+id)
                .then((result) => {
                    Swal.fire({
                        type: 'success',
                        title: 'saved',
                        showConfirmButton: false,
                        timer: 500,
                    })
                    this.dialog = false;
                    this.initialize();
                }).catch((err) => {
                    Swal.fire({
                        type: 'error',
                        title: 'Ooops',
                        text: err
                    })
                });
        },
        fetchPost(id) {
            axios({
                    url: '/api/user/'+ id,
                    method: "get"
                })
                .then((result) => {
                    this.form.name=result.data.user.name
                    this.form.username=result.data.user.email
                    this.form.level=result.data.user.level
                }).catch((err) => {

                });
        },
        trueview(id) {
            axios({
                    url: '/api/edithak',
                    method: "post",
                    data: {
                    id: id,
                    view: '1' 
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
        falseview(id) {
            axios({
                    url: '/api/edithak',
                    method: "post",
                    data: {
                    id: id,
                    view: '0' 
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
        trueadd(id) {
            axios({
                    url: '/api/edithak',
                    method: "post",
                    data: {
                    id: id,
                    add: '1' 
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
        falseadd(id) {
            axios({
                    url: '/api/edithak',
                    method: "post",
                    data: {
                    id: id,
                    add: '0' 
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
        trueedit(id) {
            axios({
                    url: '/api/edithak',
                    method: "post",
                    data: {
                    id: id,
                    edit: '1' 
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
        falseedit(id) {
            axios({
                    url: '/api/edithak',
                    method: "post",
                    data: {
                    id: id,
                    edit: '0' 
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
        truedelete(id) {
            axios({
                    url: '/api/edithak',
                    method: "post",
                    data: {
                    id: id,
                    delete: '1' 
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
        falsedelete(id) {
            axios({
                    url: '/api/edithak',
                    method: "post",
                    data: {
                    id: id,
                    delete: '0' 
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
        editPost(id) {
            this.form.patch('/api/user/edit/' + id)
                .then((result) => {
                    Swal.fire({
                        type: 'success',
                        title: 'saved',
                        showConfirmButton: false,
                        timer: 500,
                    })
                   this.$router.push('/admin/managementuser/'+id)
                }).catch((err) => {
                    Swal.fire({
                        type: 'error',
                        title: 'Ooops',
                        text: err
                    })
                });
        },
        initialize () {
            axios({
                    url: '/api/halamanakses/'+this.$route.params.id,
                    method: "get"
                })
                .then((result) => {
                    this.halamanakses = result.data.halamanakses
                }).catch((err) => {

                });

            axios({
                    url: '/api/halaman/',
                    method: "get"
                })
                .then((result) => {
                    this.halaman = result.data.setHalaman
                }).catch((err) => {

                });
        },
    },
    mounted() {
        var id = this.$route.params.id
        if (id) {
            this.fetchPost(id)
        }

        this.initialize()

    }
}
</script>
