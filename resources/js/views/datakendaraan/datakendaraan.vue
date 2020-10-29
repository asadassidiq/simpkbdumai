<template>
<v-container fluid>
 <form @submit.prevent="savePost">
	<v-row dense color="blue">
    <v-col cols="12">
    <v-card class="mx-auto">
        
    </v-card>
    </v-col>

    <v-col cols="12">
    <v-card class="mx-auto yellow lighten-3">
    <v-card-title>Identitas Kendaraan</v-card-title>
    <v-card-subtitle>
    <v-row>
        <v-col cols="12" sm="4" md="3">
          <v-text-field v-model="form.nouji" name="nouji" label="No Uji" outlined readonly dense required></v-text-field>
        </v-col>
        <v-col cols="12" sm="4" md="3">
          <v-text-field name="noregistrasikendaraan" v-model="form.noregistrasikendaraan" label="No Kendaraan" outlined dense required readonly></v-text-field>
        </v-col>
        <v-col cols="12" sm="4" md="3">
              <v-text-field name="nama" v-model="form.nama" label="Nama" outlined dense required readonly></v-text-field>
        </v-col>
        <v-col cols="12" sm="4" md="3">
          <v-text-field name="noidentitaspemilik" v-model="form.noidentitaspemilik" label="Nomer Identitas" outlined dense required readonly></v-text-field>
        </v-col>
        <v-col cols="12" sm="4" md="3">
          <v-textarea auto-grow row="4" v-model="form.alamat" row-height="10" name="alamat" label="Alamat" outlined dense required readonly></v-textarea>
        </v-col>
        <v-col cols="12" sm="4" md="3">
          <v-text-field name="nosertifikatreg" v-model="form.nosertifikatreg" label="No Sertifikat Reg" outlined dense required clearable></v-text-field>
        </v-col>
        <v-col cols="12" sm="6" md="3">
        <v-menu ref="menu" v-model="menu":close-on-content-click="false" :return-value.sync="date"
          transition="scale-transition" offset-y min-width="290px">
          <template v-slot:activator="{ on, attrs }">
            <v-text-field v-model="form.tglsertifikatreg" name="tglsertifikatreg" label="Tgl Sertifikat Reg" outlined dense required v-bind="attrs" v-on="on"
            ></v-text-field>
          </template>
          <v-date-picker v-model="form.tglsertifikatreg" no-title scrollable>
            <v-spacer></v-spacer>
            <v-btn text color="primary" @click="menu = false">Cancel</v-btn>
            <v-btn text color="primary" @click="$refs.menu.save(date)">OK</v-btn>
          </v-date-picker>
        </v-menu>
      </v-col>
        
        <v-col cols="12" sm="4" md="3">
          <v-autocomplete :items="jenis" item-text="jenis" 
              item-value="jenis" v-model="form.jenis" name="jenis" dense required outlined label="Jenis">
            </v-autocomplete>
        </v-col>
        <v-col cols="12" sm="4" md="3">
          <v-text-field name="thpembuatan" v-model="form.thpembuatan" label="Tahun Pembuatan" outlined dense required readonly></v-text-field>
        </v-col>
        <v-col cols="12" sm="4" md="3">
          <v-text-field name="isisilender" v-model="form.isisilinder"  label="Isi Silender" outlined dense required clearable></v-text-field>
        </v-col>
        <v-col class="d-flex" cols="12" sm="4" md="3">
          <v-select :items="bahanbakar" v-model="form.bahanbakar" name="bahanbakar" label="Bahan Bakar" return-object outlined dense required clearable></v-select>
        </v-col>
        <v-col cols="12" sm="4" md="3">
          <v-text-field name="nomesin" v-model="form.nomesin" label="Nomer Mesin" outlined dense required clearable></v-text-field>
        </v-col>
        <v-col cols="12" sm="4" md="3">
          <v-text-field name="norangka" v-model="form.norangka" label="Nomer Rangka" outlined dense required clearable></v-text-field>
        </v-col>
        <v-col class="d-flex" cols="12" sm="4" md="3">
          <v-select :items="kodewilayah" item-text="namawilayah" 
          item-value="kodewilayah" name="kodewilayah" v-model="form.kodewilayah"  label="Kode Wilayah" return-object outlined dense required clearable></v-select>
        </v-col>
        <v-col class="d-flex" cols="12" sm="4" md="3">
          <v-select :items="kodewilayah" item-text="namawilayah" 
          item-value="kodewilayah" v-model="form.kodewilayahasal" name="kodewilayahasal" label="Kode Wilayah Asal" return-object outlined dense required clearable></v-select>
        </v-col>
    </v-row>
    </v-card-subtitle>
    </v-card>
    </v-col>

	<v-col cols="12">
	<v-card class="mx-auto yellow lighten-3">
	<v-card-title>Daya Angkut, Jumlah Berat, dan Kemampuan kendaraan</v-card-title>
	<v-card-subtitle>
	<v-row>
    	<v-col cols="12" sm="6" md="3">
    		<v-text-field label="JBB (Kg)" name="jbb" v-model="form.jbb" type="number"  outlined dense required></v-text-field>
    	</v-col>
    	<v-col cols="12" sm="6" md="3">
    		<v-text-field label="JBKB (Kg)" name="jbkb" v-model="form.jbkb" type="number"  outlined dense required></v-text-field>
    	</v-col>
    	<v-col cols="12" sm="6" md="3">
    		<v-text-field label="JBI (Kg)" name="jbi" v-model="form.jbi" type="number"  outlined dense required></v-text-field>
    	</v-col>
    	<v-col cols="12" sm="6" md="3">
    		<v-text-field label="JBKI (Kg)" name="jbki" v-model="form.jbki" type="number"  outlined dense required></v-text-field>
    	</v-col>
    	<v-col cols="12" sm="6" md="3">
    		<v-text-field label="Jumlah Orang" name="jmlhorang" @change="getdayangkutorang()" v-model="form.jmlhorang" type="number"  outlined dense required></v-text-field>
    	</v-col>
        <v-col cols="12" sm="6" md="3">
            <v-text-field label="Daya Angkut Orang (Kg)" name="dayaangkutorang" v-model="form.dayaangkutorang" type="number"  outlined dense required></v-text-field>
        </v-col>
    	<v-col cols="12" sm="6" md="3">
    		<v-text-field label="Daya Angkut Barang (Kg)" name="dayaangkutbarang" v-model="form.dayaangkutbarang" type="number"  outlined dense required></v-text-field>
    	</v-col>
        <v-col cols="12" sm="6" md="3">
            <v-text-field label="MST (Kg)" name="mst" v-model="form.mst" type="number"  outlined dense required></v-text-field>
        </v-col>
    	<v-col cols="12" sm="6" md="3">
    		<v-text-field label="Kelas Jalan Terendah" name="kelasjalanterendah" v-model="form.kelasjalanterendah" type="text" value="III" outlined dense required clearable></v-text-field>
    	</v-col>
    	<v-col cols="12" sm="6" md="3">
    		<v-text-field label="Konfigurasi Sumbu Roda" name="konfigurasisumburoda" v-model="form.konfigurasisumburoda" type="text" value="" outlined dense required clearable></v-text-field>
    	</v-col>
    	<v-col cols="12" sm="6" md="3">
    		<v-text-field label="Ukuran Ban" name="ukuranban" v-model="form.ukuranban" type="text" value="" outlined dense required clearable></v-text-field>
    	</v-col>
	</v-row>
	</v-card-subtitle>
	</v-card>
	</v-col>

    <v-col cols="12">
    <v-card class="mx-auto yellow lighten-3">
    <v-card-title>Berak Kosong Kendaraan</v-card-title>
    <v-card-subtitle>
    <v-row>
        <v-col cols="12" sm="6" md="3">
            <v-text-field label="Berat Sumbu I (Kg)" name="beratsumbu1" v-model="form.beratsumbu1" type="number"  outlined dense required></v-text-field>
        </v-col>
        <v-col cols="12" sm="6" md="3">
            <v-text-field label="Berat Sumbu II (Kg)" name="beratsumbu2" v-model="form.beratsumbu2" type="number"  outlined dense required></v-text-field>
        </v-col>
        <v-col cols="12" sm="6" md="3">
            <v-text-field label="Berat Sumbu III (Kg)" name="beratsumbu3" v-model="form.beratsumbu3" type="number"  outlined dense required></v-text-field>
        </v-col>
        <v-col cols="12" sm="6" md="3">
            <v-text-field label="Berat Sumbu IV  (Kg)" name="beratsumbu4" v-model="form.beratsumbu4" type="number"  outlined dense required></v-text-field>
        </v-col>
        <v-col cols="12" sm="6" md="4">
            
            <v-row>
                <v-col cols="9">
                <v-text-field label="Berat Kosong (Kg)" name="beratkosong" v-model="form.beratkosong" type="number"  outlined dense required></v-text-field>
                </v-col>
                <v-col cols="3">
                <v-btn class="mx-2" fab dark small color="primary" @click="getbk()" ><v-icon dark> mdi-calculator-variant-outline </v-icon></v-btn>
                </v-col>
            </v-row>
        </v-col>
    </v-row>
    </v-card-subtitle>
    </v-card>
    </v-col>

	<v-col cols="12">
	<v-card class="mx-auto yellow lighten-3">
	<v-card-title>Dimensi Kendaraan</v-card-title>
	<v-card-subtitle>
	<v-row>
    	<v-col cols="12" sm="6" md="3">
    		<v-text-field label="Panjang Kendaraan" name="panjangkendaraan" v-model="form.panjangkendaraan" type="number"  outlined dense required></v-text-field>
    	</v-col>
    	<v-col cols="12" sm="6" md="3">
    		<v-text-field label="Lebar Kendaraan" name="lebarkendaraan" v-model="form.lebarkendaraan" type="number"  outlined dense required></v-text-field>
    	</v-col>
    	<v-col cols="12" sm="6" md="3">
    		<v-text-field label="Tinggi Kendaraan (mm)" name="tinggikendaraan" v-model="form.tinggikendaraan" type="number"  outlined dense required></v-text-field>
    	</v-col>
    	<v-col cols="12" sm="6" md="3">
    		<v-text-field label="Rear Over Hang (mm)" name="julurbelakang" v-model="form.julurbelakang" type="number"  outlined dense required></v-text-field>
    	</v-col>
    	<v-col cols="12" sm="6" md="3">
    		<v-text-field label="Front Over Hang (mm)" name="julurdepan" v-model="form.julurdepan" type="number"  outlined dense required></v-text-field>
    	</v-col>
    	<v-col cols="12" sm="6" md="3">
    		<v-text-field label="Ground Clearance (mm)" name="groundclearance" v-model="form.groundclearance" type="number"  outlined dense required></v-text-field>
    	</v-col>
	</v-row>
	</v-card-subtitle>
	</v-card>
	</v-col>

	<v-col cols="12">
	<v-card class="mx-auto yellow lighten-3">
	<v-card-title>Jarak Sumbu</v-card-title>
	<v-card-subtitle>
	<v-row>
    	<v-col cols="12" sm="6" md="3">
    		<v-text-field label="I-II (mm)" name="jaraksumbu1_2" v-model="form.jaraksumbu1_2" type="number"  outlined dense required></v-text-field>
    	</v-col>
    	<v-col cols="12" sm="6" md="3">
    		<v-text-field label="II-III (mm)" name="jaraksumbu2_3" v-model="form.jaraksumbu2_3" type="number"  outlined dense required></v-text-field>
    	</v-col>
    	<v-col cols="12" sm="6" md="3">
    		<v-text-field label="III-IV (mm)" name="jaraksumbu3_4" v-model="form.jaraksumbu3_4" type="number"  outlined dense required></v-text-field>
    	</v-col>
    	<v-col cols="12" sm="6" md="3">
    		<v-text-field label="Q  (mm)" type="number" name="q" v-model="form.q"  outlined dense required></v-text-field>
    	</v-col>
    	<v-col cols="12" sm="6" md="3">
    		<v-text-field label="P (mm)" name="p" v-model="form.p" type="number"  outlined dense required></v-text-field>
    	</v-col>
	</v-row>
	</v-card-subtitle>
	</v-card>
	</v-col>

	<v-col cols="12">
    <v-card class="mx-auto yellow lighten-3">
    <v-card-title>Dimensi Bak Mutan</v-card-title>
    <v-card-subtitle>
    <v-row>
        <v-col cols="12" sm="6" md="3">
            <v-text-field label="Panjang (mm)" name="panjangkendaraan" v-model="form.panjangbakatautangki" type="number"  outlined dense required></v-text-field>
        </v-col>
        <v-col cols="12" sm="6" md="3">
            <v-text-field label="Lebar " name="lebarkendaraan" v-model="form.lebarbakatautangki" type="number"  outlined dense required></v-text-field>
        </v-col>
        <v-col cols="12" sm="6" md="3">
            <v-text-field label="Tinggi (mm)" name="tinggikendaraan" v-model="form.tinggibakatautangki" type="number"  outlined dense required></v-text-field>
        </v-col>
    </v-row>
    </v-card-subtitle>
    </v-card>
    </v-col>

	</v-row>
    <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="blue darken-1" text @click="goBack()">Cancel</v-btn>
        <v-btn v-if="this.$route.params.id" outlined @click="editPost($route.params.id)" color="success">save</v-btn>
            <v-btn v-else outlined type="submit" color="success">save</v-btn>
      </v-card-actions>
    </v-card>
  </form>

  <v-dialog v-model="dialog" width="800px" >
  <form @submit.prevent="saveMerek">
      <v-card>
        <v-card-title class="grey darken-2">
          Create Merek
        </v-card-title>
        <v-container>
          <v-row class="mx-2">
            <v-col cols="12">
              <v-text-field prepend-icon="mdi-mail" v-model="formmerek.merek" name="merek" class="inputUp" placeholder="Merek" ></v-text-field>
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

    <v-dialog v-model="dialogtipe" width="800px" >
    <form @submit.prevent="saveTipe">
      <v-card>
        <v-card-title class="grey darken-2">
          Create Tipe
        </v-card-title>
        <v-container>
          <v-row class="mx-2">
            <v-col cols="6">
              <v-autocomplete  :items="merek" item-text="merek" 
              item-value="id" v-model="formtipe.merek" name="merek" dense required outlined label="Merek">
            </v-autocomplete>
            </v-col>
            <v-col cols="6">
              <v-text-field placeholder="Tipe" v-model="formtipe.tipe" name="tipe" class="inputUp"  dense required outlined ></v-text-field>
            </v-col>
          </v-row>
        </v-container>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn text color="primary" @click="dialogtipe = false" >Cancel</v-btn>
          <v-btn text type="submit">Save</v-btn>
        </v-card-actions>
      </v-card>
      </form>
    </v-dialog>
</v-container>
</template>
<style>
    .inputUp input{
      text-transform: uppercase
    }
</style>
<script>
export default {
    data() {
        return ({
            post: {},
            jenispendaftaran: [],
            merek: [],
            tipe: [],
            kodewilayah: [],
            bahanbakar : [ 'Bensin', 'Solar', 'Gas' ],
            dialog: false,
            dialogtipe : false,
            form: new Form({
                jenispendaftaran: '',
                nouji: '',
                nosertifikatreg: '',
                tglsertifikatreg: new Date().toISOString().substr(0, 10),
                noregistrasikendaraan: '',
                nama: '',
                noidentitaspemilik: '',
                merek: '',
                tipe: '',
                alamat: '',
                thpembuatan: '',
                isisilinder: '',
                bahanbakar: '',
                nomesin: '',
                norangka: '',
                jbb: '0',
                kodewilayah: '',
                kodewilayahasal: '',
                jbi: '0',
                jbkb: '0',
                jbki: '0',
                mst: '0',
                jmlhorang:'0',
                dayaangkutbarang : '0',
                dayaangkutorang: '0',
                kelasjalanterendah: '',
                konfigurasisumburoda: '',
                ukuranban:  '',
                panjangkendaraan: '0',
                lebarkendaraan: '0',
                tinggikendaraan: '0',
                julurbelakang: '0',
                julurdepan: '0',
                groundclearance: '0',
                jaraksumbu1_2: '0',
                jaraksumbu2_3: '0',
                jaraksumbu3_4: '0',
                p: '0',
                q:  '0',
                beratsumbu1: '0',
                beratsumbu2: '0',
                beratsumbu3: '0',
                beratsumbu4: '0',
                beratkosong:'0',
                panjangbakatautangki:'0',
                lebarbakatautangki:'0',
                tinggibakatautangki:'0',
            }),

            formmerek: new Form({
                merek: '',
            }),
            formtipe: new Form({
                merek: '',
                tipe: '',
            }),
            date: new Date().toISOString().substr(0, 10),
            menu: false,
            modal: false,
            menu2: false,
        })
    },
    methods: {
        goBack() {
          window.history.length > 1 ? this.$router.go(-1) : this.$router.push('/')
        },
        getdayangkutorang(){
            this.form.dayaangkutorang = this.form.jmlhorang*60;
        },
        getbk(){
            if(this.form.beratsumbu4 > 0){
            this.form.beratkosong = parseInt(this.form.beratsumbu1)+parseInt(this.form.beratsumbu2)+parseInt(this.form.beratsumbu3)+parseInt(this.form.beratsumbu4)
            console.log('4')
            }else if(this.form.beratsumbu3 > 0){
                this.form.beratkosong = parseInt(this.form.beratsumbu1)+parseInt(this.form.beratsumbu2)+parseInt(this.form.beratsumbu3)
            console.log('3')
            }else if(this.form.beratsumbu2 > 0){
                this.form.beratkosong = parseInt(this.form.beratsumbu1)+parseInt(this.form.beratsumbu2)
            console.log('2')
            }else if(this.form.beratsumbu1 > 0){
                this.form.beratkosong = parseInt(this.form.beratsumbu1)
            console.log('1')
            }
            
        },
        savePost() {
            this.form.post('/api/datakendaraan/new')
                .then((result) => {
                    Swal.fire({
                        type: 'success',
                        title: 'saved',
                        showConfirmButton: false,
                        timer: 500,
                    })
                    this.$router.push('/admin/datakendaraan')
                }).catch((err) => {
                    Swal.fire({
                        type: 'error',
                        title: 'Ooops',
                        text: err
                    })
                });
        },
        saveMerek() {
            this.formmerek.post('/api/merek/new')
                .then((result) => {
                    Swal.fire({
                        type: 'success',
                        title: 'saved',
                        showConfirmButton: false,
                        timer: 500,
                    })
                    this.dialog = false
                    axios({
                        url: '/api/mereks/',
                        method: "get"
                    })
                    .then((result) => {
                        this.merek = result.data.masters
                    }).catch((err) => {

                    });
                }).catch((err) => {
                    Swal.fire({
                        type: 'error',
                        title: 'Ooops',
                        text: err
                    })
                });
        },
        saveTipe() {
            this.formtipe.post('/api/tipe/new')
                .then((result) => {
                    Swal.fire({
                        type: 'success',
                        title: 'saved',
                        showConfirmButton: false,
                        timer: 500,
                    })
                    this.dialogtipe = false
                    axios({
                        url: '/api/tipe/',
                        method: "get"
                    })
                    .then((result) => {
                        this.tipe = result.data.masters
                    }).catch((err) => {

                    });
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
                    url: '/api/datakendaraan/'+ id,
                    method: "get"
                })
                .then((result) => {
                    Vue.set(this.$data, 'post', result.data.kendaraan)
                    this.form.fill(this.post)
                    this.form.jenis = this.post.jenis
                    this.form.merek = this.post.merek
                    this.form.tipe = this.post.tipe
                    this.form.jmlhorang = this.form.dayaangkutorang/60;
                }).catch((err) => {

                });
        },
        editPost(id) {
            this.form.patch('/api/datakendaraan/edit/' + id)
                .then((result) => {
                    Swal.fire({
                        type: 'success',
                        title: 'saved',
                        showConfirmButton: false,
                        timer: 500,
                    })
                   this.$router.push('/admin/datakendaraans')
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
                    url: '/api/mereks/',
                    method: "get"
                })
                .then((result) => {
                    this.merek = result.data.masters
                }).catch((err) => {

                });
            axios({
                    url: '/api/tipe/',
                    method: "get"
                })
                .then((result) => {
                    this.tipe = result.data.masters
                }).catch((err) => {

                });
            axios({
                    url: '/api/kodewilayah/',
                    method: "get"
                })
                .then((result) => {
                    this.kodewilayah = result.data.kodewilayahs
                }).catch((err) => {

                });
          axios({
                    url: '/api/jenis/',
                    method: "get"
                })
                .then((result) => {
                    this.jenis = result.data.masters
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