<template>
<v-container fluid >
    <v-col cols="12">
    <v-bottom-navigation :value="activeBtn" v-model="activeBtn" color="lime" horizontal >
        <v-btn v-show="halamanakses == '1'" @click="refreshPost()"><span>POS 1</span><v-icon>mdi-map-marker</v-icon></v-btn>

        <v-btn v-show="halamanakses2 == '1'" @click="refreshPost()"><span>POS 2</span><v-icon>mdi-map-marker</v-icon></v-btn> 
      </v-bottom-navigation>
    </v-col>
    <div v-if="activeBtn == '0'">
    <v-card color="lime lighten-3 black--text">
    <v-card-title>
      Pendaftaran POS 1
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
          <v-data-table :headers="headers" :items="pendaftarans" :search="search" class="elevation-1  yellow lighten-3">
            <template v-slot:item.actions="{ item }">
                <div class="text-center d-flex align-center">
                    <v-tooltip top>
                        <template v-slot:activator="{on}">
                            <v-btn class="v-btn-simple" color="success" icon v-on="on" @click="editpendaftaran(item.id)">
                                <v-icon>mdi-cog-clockwise</v-icon>
                            </v-btn>
                        </template>
                        <span>proses uji</span>
                    </v-tooltip>
                </div>

            </template>
        </v-data-table>
    </div>

    <div v-if="activeBtn == '1'">
    <v-card color="lime lighten-3 black--text">
    <v-card-title>
      Pendaftaran POS 2
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
                            <v-btn class="v-btn-simple" color="success" icon v-on="on" @click="editpendaftaran(item.id)">
                                <v-icon>mdi-cog-clockwise</v-icon>
                            </v-btn>
                        </template>
                        <span>proses uji</span>
                    </v-tooltip>
                </div>

            </template>
        </v-data-table>
    </div>
    </v-container>
</template>
<script>
export default {
    data() {
        return {
            search: '',
            headers: [
                { text: 'No Kendaraan', value: 'identitaskendaraan.noregistrasikendaraan' },
                { text: 'No Uji', value: 'identitaskendaraan.nouji' },
                { text: 'Nama', value: 'identitaskendaraan.nama' },
                { text: 'Th Pembuatan', value: 'identitaskendaraan.thpembuatan' },
                { text: 'Jenis Pendaftaran', value: 'kodepenerbitans.keterangan' },
                { text: 'Actions', value: 'actions', sortable: false },
            ],
            form: new Form({}),
            activeBtn: '',
            halamanakses: [],
            halamanakses2: [],
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
        refreshPost() {
            if(this.activeBtn == 1){
                this.$store.dispatch('getPendaftaranPos2');
            }else{
                this.$store.dispatch('getPendaftaranPos1');
            }
        },
        editpendaftaran(id) {
            this.$router.push('/uji/pengujians/' + id)
        },
        initialize() {
            var id = JSON.parse(localStorage.getItem("user"));
            axios({
                    url: '/api/cekakses1/'+id.id,
                    method: "get",
                })
                .then((result) => {
                    this.halamanakses = result.data.halamanakses
					if(this.halamanakses === 1 )
						this.activeBtn = 0
                        this.refreshPost();
                }).catch((err) => {

                });
            axios({
                    url: '/api/cekakses2/'+id.id,
                    method: "get",
                })
                .then((result) => {
                    this.halamanakses2 = result.data.halamanakses
					if(this.halamanakses2 === 1 )
						this.activeBtn = 1
                        this.refreshPost();
                }).catch((err) => {

                });
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
    },
    created() {
        this.initialize();
        Fire.$on('afterCreate', () => {
        })
    }
}
</script>
