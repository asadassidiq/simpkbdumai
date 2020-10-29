<template>
<v-container fluid >
      
      <v-btn bottom color="pink" dark fab fixed right @click="dialog = !dialog">
        <v-icon>mdi-plus</v-icon>
      </v-btn>
     
    <v-card-title>
      Master Klasifikasi
      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
          <v-data-table :headers="headers" :items="pendaftarans" :search="search" class="elevation-1">
            <template v-slot:item.actions="{ item }">
                <div class="text-center d-flex align-center">
                    <v-tooltip top>
                        <template v-slot:activator="{on}">
                            <v-btn class="v-btn-simple" color="success" icon v-on="on" @click="editpendaftaran(item.id)">
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
              Create Klasifikasi
            </v-card-title>
            <v-container>
              <v-row class="mx-2">
                <v-col cols="12">
                    <v-text-field v-model="form.klasifikasi" label="Klasifikasi" required></v-text-field>
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
                { text: 'Klasifikasi', value: 'klasifikasis' },
                { text: 'Actions', value: 'actions', sortable: false },
            ],
            form: new Form({
                klasifikasi: '',
            })
        }
    },
    methods: {
        savePost() {
            this.form.post('/api/klasifikasi/new')
                .then((result) => {
                    Swal.fire({
                        type: 'success',
                        title: 'saved',
                        showConfirmButton: false,
                        timer: 500,
                    })
                    this.dialog = false
                    this.$router.push('/admin/klasifikasi')
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
                    this.form.delete('/api/pendaftarans/' + id)
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
        refreshPost() {
            this.$store.dispatch('getKlasifikasi');
        },
        editpendaftaran(id) {
            this.$router.push('/admin/datakendaraan/' + id)
        }
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
        this.$store.dispatch('getKlasifikasi');
    },
    created() {
        Fire.$on('afterCreate', () => {
            this.refreshPost();
        })
        this.refreshPost();
    }
}
</script>
