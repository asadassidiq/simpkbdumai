<template>
<v-container fluid >
<v-card color="lime lighten-3 black--text">
    <v-card-title>
      Pendaftaran
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
          <template v-slot:item.pos1="{ item }">
                <div class="text-center d-flex align-center">
                    <v-tooltip top>
                        <template v-slot:activator="{on}">
                            <v-btn class="v-btn-simple" v-if="item.pos1 == '2'" color="error" icon v-on="on" @click="editpendaftaran(item.identitaskendaraan_id)">
                                <v-icon>mdi-alert-remove</v-icon>
                            </v-btn>
                            <v-btn class="v-btn-simple" v-else-if="item.pos1 == '1'" color="success" icon v-on="on" @click="editpendaftaran(item.identitaskendaraan_id)">
                                <v-icon>mdi-checkbox-marked-circle-outline</v-icon>
                            </v-btn>
                        </template>
                        <span>edit{{ item.pos1 }}</span>
                    </v-tooltip>
                </div>
            </template>
            <template v-slot:item.pos2="{ item }">
                <div class="text-center d-flex align-center">
                    <v-tooltip top>
                        <template v-slot:activator="{on}">
                            <v-btn class="v-btn-simple" v-if="item.pos2 == '2'" color="error" icon v-on="on" @click="editpendaftaran(item.identitaskendaraan_id)">
                                <v-icon>mdi-alert-remove</v-icon>
                            </v-btn>
                            <v-btn class="v-btn-simple" v-else-if="item.pos2 == '1'" color="success" icon v-on="on" @click="editpendaftaran(item.identitaskendaraan_id)">
                                <v-icon>mdi-checkbox-marked-circle-outline</v-icon>
                            </v-btn>
                        </template>
                        <span>edit</span>
                    </v-tooltip>
                </div>
            </template>
            <template v-slot:item.actions="{ item }">
                <div class="text-center d-flex align-center">
                    <v-tooltip top>
                        <template v-slot:activator="{on}">
                            <v-btn class="v-btn-simple" color="primary" icon v-on="on" @click.stop="setAcc(item.id)">
                                <v-icon>mdi-cog-clockwise</v-icon>
                            </v-btn>
                        </template>
                        <span>ACC</span>
                    </v-tooltip>
                </div>
            </template>
        </v-data-table>

        <v-dialog v-model="dialog" max-width="290" >
          <v-card>
            <v-card-title class="headline">
              Apakah sudah yakin?
            </v-card-title>

            <v-card-text>
              Jika sudah yakin untuk meluluskan pengujian kendaraan maka data akan di sinkronkan ke data Kementrian. Jika tidak maka segera kembalikan ke pos untuk di uji kembali!.
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>

              <v-btn color="green darken-1" text  @click="dialog = false" >
                Cancel
              </v-btn>
              <v-btn color="green darken-1" text  @click="rejected()" >
                Gagal
              </v-btn>
              <v-btn color="green darken-1" text @click="acc()"  >
                Setuju
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
    </v-container>
</template>
<script>
export default {
    data() {
        return {
            search: '',
            idAcc: '',
            headers: [
                { text: 'No Kendaraan', value: 'identitaskendaraan.noregistrasikendaraan' },
                { text: 'No Uji', value: 'identitaskendaraan.nouji' },
                { text: 'Nama', value: 'identitaskendaraan.nama' },
                { text: 'Jenis Pendaftaran', value: 'kodepenerbitans.keterangan' },
                { text: 'Pos1', value: 'pos1', sortable: false },
                { text: 'Pos2', value: 'pos2', sortable: false },
                { text: 'Actions', value: 'actions', sortable: false },
            ],
            form: new Form({
                    idpenguji: '',
            }),
            dialog: false,
        }
    },
    methods: {
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
        initialize() {
            var id = JSON.parse(localStorage.getItem("user"));
                this.form.idpenguji = id.id
        },
        setAcc(id){
            this.idAcc = id
            this.dialog = true
        },
        acc(){
        this.form.patch('/api/pengujian/acc/' + this.idAcc)
                .then((result) => {
                    Swal.fire({
                                type: 'success',
                                title: 'saved',
                                showConfirmButton: false,
                                timer: 500,
                            })
                            this.dialog = false;
                    }).catch((err) => {
                    Swal.fire({
                        type: 'error',
                        title: 'Ooops',
                        text: err
                    })
                });
        },
        rejected(){
            this.form.patch('/api/pengujian/rejected/' + this.idAcc)
                .then((result) => {
                    Swal.fire({
                                type: 'success',
                                title: 'saved',
                                showConfirmButton: false,
                                timer: 500,
                            })
                            this.dialog = false;
                    }).catch((err) => {
                    Swal.fire({
                        type: 'error',
                        title: 'Ooops',
                        text: err
                    })
                });
        },
        refreshPost() {
            this.$store.dispatch('getVerif');
        },
        editpendaftaran(id) {
            this.$router.push('/uji/pengujians/' + id)
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
        this.$store.dispatch('getVerif');
    },
    created() {
        Fire.$on('afterCreate', () => {
            this.refreshPost();
        })
        this.refreshPost();
        this.initialize();
    }
}
</script>
