<template>
<v-container fluid >
      <v-btn bottom color="blue" dark fab fixed right @click="dialog = !dialog">
        <v-icon>mdi-plus</v-icon>
      </v-btn>
    <v-card color="lime lighten-3 black--text">
    <v-card-title>
      Management Users
      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
    </v-card>
          <v-data-table :headers="headers" :items="pendaftarans" :search="search" class="elevation-1 yellow lighten-3">
            <template v-slot:item.actions="{ item }">
                <div class="text-center d-flex align-center">
                    <v-tooltip top>
                        <template v-slot:activator="{on}">
                            <v-btn class="v-btn-simple" color="success" icon v-on="on" @click="edituser(item.id)">
                                <v-icon>mdi-pencil</v-icon>
                            </v-btn>
                        </template>
                        <span>edit</span>
                    </v-tooltip>
                    <v-tooltip top>
                        <template v-slot:activator="{on}">
                            <v-btn class="v-btn-simple" color="error" icon v-on="on" @click="deletependaftaran(item.id)">
                                <v-icon>mdi-trash-can</v-icon>
                            </v-btn>
                        </template>
                        <span>delete</span>
                    </v-tooltip>
                </div>

            </template>
        </v-data-table>

        <v-dialog v-model="dialog" width="800px" >
        <form @submit.prevent="savePost">
          <v-card>
            <v-card-title class="grey darken-2">
              Create User
            </v-card-title>
            <v-container>
              <v-row class="mx-2">
                <v-col cols="12">
                    <v-text-field v-model="form.name" label="Name*" required></v-text-field>
                </v-col>
                <v-col cols="12" sm="6">
                    <v-text-field v-model="form.username" label="Username*" required></v-text-field>
                </v-col>
                <v-col cols="12" sm="6">
                    <v-text-field label="Password*" v-model="form.password" type="password" required></v-text-field>
                </v-col>
                <v-col cols="12" sm="6">
                    <v-select 
                    :items="['Pendaftaran', 'Retribusi', 'Cetak', 'Penguji', 'Verifikator']" label="Level*" v-model="form.level" required >
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
            search: '',
            dialog: false,
            headers: [
                { text: 'Nama', value: 'name' },
                { text: 'Username', value: 'email' },
                { text: 'Level', value: 'level' },
                { text: 'Actions', value: 'actions', sortable: false },
            ],
            form: new Form({
                name: '',
                username: '',
                password: '',
                level: '',
            })

        }
    },
    methods: {
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
                    this.refreshPost()
                }).catch((err) => {
                    Swal.fire({
                        type: 'error',
                        title: 'Ooops',
                        text: err
                    })
                });
        },
        deletependaftaran(id) {
            Swal.fire({
                title: 'Anda yakin hapus pendaftaran ini?',
                text: "Silahkan pastikan data yang di hapus benar!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then((result) => {
                if (result.value) {
                    this.form.delete('/api/pendaftaran/' + id)
                     Fire.$emit('afterCreate')
                        Swal.fire(
                            'Deleted!',
                            'success'
                        )
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
        print(id){
            window.open('/cetak/'+id+'/print', "_blank");
        },
        refreshPost() {
            this.$store.dispatch('getUsers');
        },
        edituser(id) {
            this.$router.push('/admin/managementuser/' + id)
        },
        
    },
    computed: {
        pendaftarans() {
            return this.$store.getters.pendaftarans;
        },
    },
    mounted() {
        if (this.pendaftarans.length) {
            return;
        }
        this.$store.dispatch('getUsers');
    },
    created() {
        Fire.$on('afterCreate', () => {
            this.refreshPost();
        })
        this.refreshPost();
    }
}
</script>
