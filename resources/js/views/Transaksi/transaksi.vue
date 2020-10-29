<template>
<v-container fluid >
  <form @submit.prevent="savePost">
  <v-row dense>
    <v-col cols="12">
    <v-card color="lime lighten-3 black--text">
      <v-card-title>
        <span class="headline">Identitas Kendaraan</span>
      </v-card-title>
      <v-card-text>
        <v-container>
        <v-row>
        	<v-col cols="12" sm="3">
	          <v-text-field v-model="formdata.noregistrasikendaraan" label="Nomer Kendaraan" outlined readonly></v-text-field>
	        </v-col>
	        <v-col cols="12" sm="3">
	          <v-text-field v-model="formdata.nouji" label="Nomer Uji" outlined readonly></v-text-field>
	        </v-col>
	        <v-col cols="12" sm="3">
	          <v-text-field v-model="formdata.nama" label="Nama Pemilik" outlined readonly></v-text-field>
	        </v-col>
	        <v-col cols="12" sm="3">
	          <v-text-field  label="Jenis Kendaraan" v-model="formdata.jenis" outlined readonly></v-text-field>
	        </v-col>
	        <v-col cols="12" sm="3">
	          <v-text-field  v-model="formdata.jbb" label="JBB" outlined readonly></v-text-field>
	        </v-col>
	        <v-col cols="12" sm="3">
	          <v-text-field  label="Peruntukan" v-model="formdata.peruntukan" outlined readonly></v-text-field>
	        </v-col>
	        <v-col cols="12" sm="3">
	          <v-autocomplete :items="jenispendaftaran" item-text="keterangan" 
              item-value="id" v-model="formdata.jenispendaftaran"  label="Jenis Pendaftaran" name="jenispendaftaran" return-object outlined dense readonly></v-autocomplete>
	        </v-col>
        </v-row>
      	</v-container>
      </v-card-text>
     </v-card>
     </v-col>

    <v-col cols="12">
     <v-card color="lime lighten-3 black--text">
      <v-card-title>
        <span class="headline">Transaksi</span>
      </v-card-title>
      <v-card-text>
        <v-container>
        <v-simple-table class="lime lighten-3 black--text">
            <template v-slot:default>
              <thead>
                <tr>
                  <th class="text-left" width="80px">
                    Status
                  </th>
                  <th class="text-left">
                    Uraian
                  </th>
                  <th class="text-left">
                    Biaya
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><v-checkbox v-model="retribusi"></v-checkbox></td>
                  <td>Retribusi</td>
                  <td><v-text-field v-model="form.retribusi" solo></v-text-field></td>
                </tr>
                <tr>
                  <td><v-checkbox v-model="registrasi"></v-checkbox></td>
                  <td>Registrasi Kendaraan</td>
                  <td><v-text-field  v-model="form.registrasi" solo></v-text-field></td>
                </tr>
                <tr>
                  <td><v-checkbox v-model="bukuuji" @click="setbukuuji()"></v-checkbox></td>
                  <td><v-select :items="items" v-model="formbuku.jenis" label="Buku Uji" @change="getbukuuji()" solo></v-select></td>
                  <td><v-text-field v-model="form.buku" solo></v-text-field></td>
                </tr>
                <tr>
                  <td><v-checkbox v-model="platuji" @click="setplatuji()"></v-checkbox></td>
                  <td>Plat Uji</td>
                  <td><v-text-field v-model="form.platuji" solo></v-text-field></td>
                </tr>
                <tr>
                  <td><v-checkbox v-model="tandasamping" @click="settandasamping()"></v-checkbox></td>
                  <td>Stiker</td>
                  <td><v-text-field v-model="form.stiker" solo></v-text-field></td>
                </tr>
                <tr>
                  <td><v-checkbox v-model="denda" @click="setdenda()"></v-checkbox></td>
                  <td>
                    <v-text-field label="Bulan Denda" min="0" v-model="form.blndenda" @change="getdenda()" type="number" outlined></v-text-field>
                  </td>
                  <td><v-text-field v-model="form.denda" solo></v-text-field></td>
                </tr>
                <tr class="text-right">
                    <td colspan="2">TOTAL</td>
                    <td><v-text-field v-model="form.total" solo></v-text-field></td>
                </tr>
              </tbody>
            </template>
          </v-simple-table>
      	</v-container>
      </v-card-text>
     </v-card>
     </v-col>
     </v-row>

     <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="blue darken-1" text @click="goBack">Cancel</v-btn>
        <v-btn v-if="this.$route.params.id" outlined @click="editPost($route.params.id)" color="success">save</v-btn>
            <v-btn v-else outlined type="submit" color="success">save</v-btn>
      </v-card-actions>
    </v-card>
  </form>
</v-container>
</template>

<script>
export default {
    data() {
        return ({
            post: {},
            retribusi:true,
            registrasi:true,
            bukuuji:false,
            tandasamping:false,
            platuji:false,
            denda:false,
            items: ['Buku Uji Baru', 'Buku Uji Rusak', 'Buku Uji Hilang'],
            jenispendaftaran: [],
            biayadenda:'',
            form: new Form({
                buku: 0,
                ketbuku:'',
                registrasi: 0,
                blndenda:0,
                stiker: 0,
                denda: 0,
                total:0,
                retribusi:0,
                platuji: 0,
            }),

            formbuku : new Form({
                jenis: '',
                biaya: '',
            }),

            formdata: new Form({
                platuji: 0,
                stiker: 0,
                denda: 0,
                noregistrasikendaraan:'',
                nama:'',
                nouji:'',
                jenis:'',
                peruntukan:'',
                jenispendaftaran:'',
            })
         })
    },
    methods: {
        savePost() {
            this.form.post('/api/transaksi/new')
                .then((result) => {
                    Swal.fire({
                        type: 'success',
                        title: 'saved',
                        showConfirmButton: false,
                        timer: 500,
                    })
                    this.$router.push('/admin/transaksis')
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
                    url: '/api/pendaftaranid/'+ id,
                    method: "get"
                })
                .then((result) => {
                    Vue.set(this.$data, 'post', result.data.kendaraan)
                    this.formdata.nouji= this.post.nouji
                    this.formdata.noregistrasikendaraan= this.post.noregistrasikendaraan
                    this.formdata.jenispendaftaran= this.post.kodepenerbitans_id
                    this.formdata.nama= this.post.nama
                    this.formdata.peruntukan= this.post.peruntukan
                    this.formdata.jbb= this.post.jbb
                    this.formdata.jenis= this.post.jenis
                    console.log(result.data.kendaraan)
                    if(this.post.bukuuji > 0){
                    this.form.buku = this.post.bukuuji
                    this.formbuku.jenis = this.post.ketbuku
                    this.form.ketbuku = this.post.ketbuku
                    this.bukuuji = true
                    }
                    if(this.post.platuji > 0){
                    this.form.platuji = this.post.platuji
                    this.platuji = true
                    }
                    if(this.post.stiker > 0){
                    this.form.stiker = this.post.stiker
                    this.tandasamping = true
                    }
                    if(this.post.blndenda > 0){
                    this.form.blndenda = this.post.blndenda
                    this.form.denda = this.post.denda
                    this.denda = true
                    }
                    if(this.post.total > 0){
                    this.form.total = this.post.total
                    }
                    if(!this.post.total){
                     this.form.total = this.form.retribusi+this.form.registrasi
                    }
                }).catch((err) => {

                });
        },
        editPost(id) {
            this.form.patch('/api/transaksi/edit/' + id)
                .then((result) => {
                    Swal.fire({
                        type: 'success',
                        title: 'saved',
                        showConfirmButton: false,
                        timer: 500,
                    })
                   this.$router.push('/admin/transaksis')
                }).catch((err) => {
                    Swal.fire({
                        type: 'error',
                        title: 'Ooops',
                        text: err
                    })
                });
        },
        getbukuuji(){
           this.formbuku.post('/api/cekhargabuku')
                .then((result) => {
                    this.formbuku.biaya = result.data.masters.biaya
                    this.form.ketbuku = this.formbuku.jenis
                }).catch((err) => {
                
                });
        },
        getdenda(){
            this.formdata.denda = this.form.blndenda*this.biayadenda;
        },
        setplatuji(){
            if(this.platuji === true){ 
               this.form.total = this.form.total+this.formdata.platuji
               this.form.platuji = this.formdata.platuji
            }
            else{
                this.form.total = this.form.total-this.formdata.platuji
               this.form.platuji = 0
            }
        },
        settandasamping(){
            if(this.tandasamping === true){
                this.form.total = this.form.total+this.formdata.stiker
                this.form.stiker = this.formdata.stiker
            }
            else{
                this.form.total = this.form.total-this.formdata.stiker
                this.form.stiker = 0
            }
        },
        setbukuuji(){
            if(this.bukuuji === true){
            this.form.total = this.form.total+this.formbuku.biaya
            this.form.buku = this.formbuku.biaya
            }
            else{
            this.form.total = this.form.total-this.formbuku.biaya
            this.form.buku = 0
            }
            
        },
        setdenda(){
            if(this.denda === true){
                this.form.total = this.form.total+this.formdata.denda
                this.form.denda = this.formdata.denda
            }
            else{
                this.getdenda()
                this.form.total = this.form.total-this.formdata.denda
                this.form.denda = 0
                console.log('a')
            }
        },
        goBack() {
          window.history.length > 1 ? this.$router.go(-1) : this.$router.push('/')
        },
        initialize () {
          axios({
                    url: '/api/kodepenerbitan/',
                    method: "get"
                })
                .then((result) => {
                    this.jenispendaftaran = result.data.kodepenerbitans
                }).catch((err) => {

                });
            axios({
                    url: '/api/biayadenda/',
                    method: "get"
                })
                .then((result) => {
                    this.biayadenda = result.data.biayadenda.biaya
                }).catch((err) => {

                });
            axios({
                    url: '/api/biayaplatuji/',
                    method: "get"
                })
                .then((result) => {
                    this.formdata.platuji = result.data.biaya
                }).catch((err) => {

                });
            axios({
                    url: '/api/biayastiker/',
                    method: "get"
                })
                .then((result) => {
                    this.formdata.stiker = result.data.biaya
                }).catch((err) => {

                });
            axios({
                    url: '/api/registrasi/'+this.$route.params.id,
                    method: "get"
                })
                .then((result) => {
                    this.form.registrasi = result.data.registrasi
                }).catch((err) => {

                });
            axios({
                    url: '/api/retribusi/'+this.$route.params.id,
                    method: "get"
                })
                .then((result) => {
                    this.form.retribusi = result.data.retribusi.biaya
                }).catch((err) => {

                });
        },
    },
    mounted() {
        this.initialize()

        var id = this.$route.params.id
        if (id) {
            this.fetchPost(id)
        }

    }
}
</script>