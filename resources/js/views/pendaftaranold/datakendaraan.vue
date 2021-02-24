<template>
<v-container fluid >
  <form @submit.prevent="savePost">
    <v-card class="yellow lighten-3">
      <v-card-title>
        <span class="headline">Pendaftaran</span>
      </v-card-title>
      <v-card-text>
        <v-container>
          <v-row>
            <v-col cols="12" sm="4" md="4">
              <v-text-field v-model="form.nouji" name="nouji" label="No Uji" outlined dense clearable required></v-text-field>
            </v-col>
            <v-col cols="12" sm="4" md="4">
              <v-text-field name="noregistrasikendaraan" v-model="form.noregistrasikendaraan" label="No Kendaraan" outlined dense clearable required></v-text-field>
            </v-col>
            <v-col cols="12" sm="4" md="4">
              <v-text-field name="nama" v-model="form.nama" label="Nama" outlined dense clearable required></v-text-field>
            </v-col>
            <v-col cols="12" sm="4" md="4">
              <v-textarea filled auto-grow row="4" v-model="form.alamat" row-height="10" name="alamat" label="Alamat" outlined dense clearable required></v-textarea>
            </v-col>
            <v-col cols="12" sm="4" md="4">
              <v-text-field name="noidentitaspemilik" v-model="form.noidentitaspemilik" label="Nomer Identitas" outlined dense clearable required></v-text-field>
            </v-col>
            <v-col cols="12" sm="4" md="4">
            <v-row no-gutters>
                <v-col cols="10">
                    <v-autocomplete  :items="merek" item-text="merek" 
                      item-value="merek" v-model="form.merek" name="merek" dense required outlined label="Merek">
                    </v-autocomplete>
                </v-col>
                <v-col cols="2">
                    <v-btn class="v-btn-simple" color="error" icon v-on="on" @click="dialog = !dialog">
                        <v-icon>mdi-plus</v-icon>
                    </v-btn>
                </v-col>
            </v-row>
        </v-col>
        <v-col cols="12" sm="4" md="4">
            <v-row no-gutters>
                <v-col cols="10">
                    <v-autocomplete  :items="tipe" item-text="tipe" 
                      item-value="tipe" v-model="form.tipe" name="tipe" dense required outlined label="Tipe">
                    </v-autocomplete>
                </v-col>
                <v-col cols="2">
                    <v-btn class="v-btn-simple" color="error" icon v-on="on" @click="dialogtipe = !dialogtipe">
                        <v-icon>mdi-plus</v-icon>
                    </v-btn>
                </v-col>
            </v-row>
        </v-col>
        <v-col class="d-flex" cols="12" sm="4" md="4">
          <v-row no-gutters>
              <v-col cols="10">
                  <v-autocomplete :items="jeniskendaraan" item-text="jenis" 
                  item-value="jenis" v-model="form.jeniskendaraan" name="jeniskendaraan" label="Jenis Kendaraan" return-object outlined dense clearable required></v-autocomplete>
              </v-col>
              <v-col cols="2">
                  <v-btn class="v-btn-simple" color="error" icon v-on="on" @click="dialogjenis = !dialogjenis">
                      <v-icon>mdi-plus</v-icon>
                  </v-btn>
              </v-col>
          </v-row>
          </v-col>
            <v-col cols="12" sm="4" md="4">
              <v-text-field name="thpembuatan" v-model="form.thpembuatan" label="Tahun Pembuatan" outlined dense clearable required></v-text-field>
            </v-col>
            <v-col cols="12" sm="4" md="4">
              <v-text-field name="nomesin" v-model="form.nomesin" label="Nomer Mesin" outlined dense clearable required></v-text-field>
            </v-col>
            <v-col cols="12" sm="4" md="4">
              <v-text-field name="norangka" v-model="form.norangka" label="Nomer Rangka" outlined dense clearable required></v-text-field>
            </v-col>
            <v-col cols="12" sm="4" md="4">
              <v-text-field name="isisilender" v-model="form.isisilinder"  label="Isi Silender" outlined dense clearable required></v-text-field>
            </v-col>
            <v-col class="d-flex" cols="12" sm="4" md="4">
              <v-select :items="bahanbakar" v-model="form.bahanbakar" name="bahanbakar" label="Bahan Bakar" return-object outlined dense clearable required></v-select>
            </v-col>
            <v-col cols="12" sm="4" md="4">
              <v-text-field name="nosertifikatreg" v-model="form.nosertifikatreg" label="No Sertifikat Reg" outlined dense required clearable></v-text-field>
            </v-col>
            <v-col cols="12" sm="6" md="4">
              <v-menu ref="menu" v-model="menu":close-on-content-click="false" :return-value.sync="form.tglsertifikatreg"
                transition="scale-transition" offset-y min-width="290px">
                <template v-slot:activator="{ on, attrs }">
                  <v-text-field v-model="form.tglsertifikatreg" name="tglsertifikatreg" label="Tgl Sertifikat Reg" outlined dense required v-bind="attrs" v-on="on"
                  ></v-text-field>
                </template>
                <v-date-picker v-model="form.tglsertifikatreg" no-title scrollable>
                  <v-spacer></v-spacer>
                  <v-btn text color="primary" @click="menu = false">Cancel</v-btn>
                  <v-btn text color="primary" @click="$refs.menu.save(form.tglsertifikatreg)">OK</v-btn>
                </v-date-picker>
              </v-menu>
            </v-col>
            <v-col class="d-flex" cols="12" sm="4" md="4">
              <v-select :items="peruntukan" v-model="form.peruntukan" name="peruntukan" label="Peruntukan" return-object outlined dense clearable required></v-select>
            </v-col>
          </v-row>
        </v-container>
      </v-card-text>
    </v-card>

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

      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="blue darken-1" text @click="goBack()">Cancel</v-btn>
        <v-btn v-if="this.$route.params.id" outlined @click="editPost($route.params.id)" color="success">save</v-btn>
            <v-btn v-else outlined type="submit" color="success">save</v-btn>
      </v-card-actions>
  </form>

  <v-dialog v-model="dialogjenis" width="800px" >
    <form @submit.prevent="saveJenis">
      <v-card>
        <v-card-title class="grey darken-2">
          Create Tipe
        </v-card-title>
        <v-container>
          <v-row class="mx-2">
            <v-col cols="4">
              <v-text-field placeholder="Jenis" v-model="formjenis.jenis" name="jenis" class="inputUp"  dense required outlined ></v-text-field>
            </v-col><v-col cols="4">
              <v-autocomplete  :items="klasifikasi" item-text="klasifikasis" 
              item-value="id" v-model="formjenis.klasifikasi" name="klasifikasi" dense required outlined label="Klasifikasi">
            </v-autocomplete>
            </v-col>
            </v-col><v-col cols="4">
              <v-autocomplete  :items="jeniskendaraanIntegrasi" item-text="jeniskendaraan" 
              item-value="jeniskendaraan" v-model="formjenis.jeniskendaraan" name="jeniskendaraan" dense required outlined label="Jenis Kendaraan Kementrian">
            </v-autocomplete>
            </v-col>
          </v-row>
        </v-container>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn text color="primary" @click="dialogjenis = false" >Cancel</v-btn>
          <v-btn text type="submit">Save</v-btn>
        </v-card-actions>
      </v-card>
      </form>
    </v-dialog>


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

<script>
export default {
    data() {
        return ({
            post: {},
            dialogjenis:false,
            jeniskendaraan: [],
            jeniskendaraanIntegrasi: [],
            jenispendaftaran: [],
            klasifikasi: [],
            kodewilayah: [],
            menu3: false,
            menu2: false,
            menu1: false,
            menu: false,
            merek: [],
            tipe: [],
            dialog: false,
            dialogtipe : false,
            date: new Date().getMonth()+6,
            bahanbakar : [ 'Bensin', 'Solar', 'Gas' ],
            peruntukan : [ 'Umum', 'Tidak Umum', 'Pemerintah' ],
            form: new Form({
                jenispendaftaran: '',
                nouji: '',
                noregistrasikendaraan: '',
                nama: '',
                noidentitaspemilik: '',
                alamat: '',
                nosertifikatreg: '',
                tglsertifikatreg: new Date().toISOString().substr(0, 10),
                merek: '',
                tipe: '',
                thpembuatan: '',
                isisilinder: '',
                bahanbakar: '',
                nomesin: '',
                norangka: '',
                jbb: '0',
                kodewilayah: '',
                kodewilayahasal: '',
                peruntukan: '',
                jeniskendaraan:'',
                tglpendaftaran: new Date().toISOString().substr(0, 10),
                tglbayar: new Date().toISOString().substr(0, 10),
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
            formjenis: new Form({
                jenis:'',
                klasifikasi: '',
                jeniskendaraan: '',
            }),
            formmerek: new Form({
                merek: '',
            }),
            formtipe: new Form({
                merek: '',
                tipe: '',
            }),
        })
    },
    methods: {
        goBack() {
          window.history.length > 1 ? this.$router.go(-1) : this.$router.push('/')
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
                    this.$router.push('/admin/pendaftaranolds')
                }).catch((err) => {
                    Swal.fire({
                        type: 'error',
                        title: 'Ooops',
                        text: err
                    })
                });
        },
        saveJenis() {
            this.formjenis.post('/api/jenis/new')
                .then((result) => {
                    Swal.fire({
                        type: 'success',
                        title: 'saved',
                        showConfirmButton: false,
                        timer: 500,
                    })
                    this.initialize();
                    this.dialogjenis = false;
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
                    url: '/api/pendaftaranold/'+ id,
                    method: "get"
                })
                .then((result) => {
                    Vue.set(this.$data, 'post', result.data.kendaraan)
                    this.form.nouji= this.post.nouji
                    this.form.noregistrasikendaraan= this.post.noregistrasikendaraan
                    this.form.nama= this.post.nama
                    this.form.noidentitaspemilik= this.post.noidentitaspemilik
                    this.form.alamat= this.post.alamat
                    this.form.nosertifikatreg = this.post.nosertifikatreg
                    this.form.tglsertifikatreg = this.post.tglsertifikatreg
                    this.form.thpembuatan= this.post.thpembuatan
                    this.form.isisilinder= this.post.isisilinder
                    this.form.bahanbakar= this.post.bahanbakar
                    this.form.nomesin= this.post.nomesin
                    this.form.norangka= this.post.norangka
                    this.form.jbb= this.post.jbb
                    this.form.jeniskendaraan= this.post.jenis
                    this.form.kodewilayah= this.post.kodewilayah
                    this.form.kodewilayahasal= this.post.kodewilayahasal
                    this.form.jeniskendaraan= this.post.jenis
                    this.form.peruntukan= this.post.statuspenggunaan
                    this.form.merek= this.post.merek.toUpperCase()
                    this.form.tipe= this.post.tipe
                    this.form.jbkb= this.post.jbkb
                    this.form.jbi= this.post.jbi
                    this.form.jbki= this.post.jbki
                    this.form.dayaangkutorang = this.post.dayaangkutorang
                    this.form.dayaangkutbarang = this.post.dayaangkutbarang
                    this.form.mst = this.post.mst
                    this.form.kelasjalanterendah = this.post.kelasjalanterendah
                    this.form.ukuranban = this.post.ukuranban
                    this.form.konfigurasisumburoda = this.post.konfigurasisumburoda
                    this.form.beratkosong = this.post.beratkosong
                    this.form.beratsumbu1 = this.post.bs1
                    this.form.beratsumbu2 = this.post.bs2
                    this.form.beratsumbu3 = this.post.bs3
                    this.form.beratsumbu4 = this.post.bs4
                    this.form.panjangkendaraan = this.post.panjangkendaraan
                    this.form.lebarkendaraan = this.post.lebarkendaraan
                    this.form.tinggikendaraan = this.post.tinggikendaraan
                    this.form.jaraksumbu1_2 = this.post.jaraksumbu1_2
                    this.form.jaraksumbu2_3 = this.post.jaraksumbu2_3
                    this.form.jaraksumbu3_4 = this.post.jaraksumbu3_4
                    this.form.q = this.post.q
                    this.form.p = this.post.p
                    this.form.panjangbakatautangki = this.post.panjangbakatautangki
                    this.form.lebarbakatautangki = this.post.lebarbakatautangki
                    this.form.tinggibakatautangki = this.post.tinggibakatautangki
                }).catch((err) => {

                });
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
        editPost(id) {
            this.form.patch('/api/pendaftaranold/edit/' + id)
                .then((result) => {
                    Swal.fire({
                        type: 'success',
                        title: 'saved',
                        showConfirmButton: false,
                        timer: 500,
                    })
                   this.$router.push('/admin/pendaftaranolds')
                }).catch((err) => {
                    Swal.fire({
                        type: 'error',
                        title: 'Ooops',
                        text: err
                    })
                });
        },
        initialize() {
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
                    url: '/api/kodepenerbitan/',
                    method: "get"
                })
                .then((result) => {
                    this.jenispendaftaran = result.data.kodepenerbitans
                }).catch((err) => {

                });
          axios({
                    url: '/api/jenis/',
                    method: "get"
                })
                .then((result) => {
                    this.jeniskendaraan = result.data.masters
                }).catch((err) => {

                });
            axios({
                    url: '/api/jeniskendaraan/',
                    method: "get"
                })
                .then((result) => {
                    this.jeniskendaraanIntegrasi = result.data.masters
                }).catch((err) => {

                });
            axios({
                    url: '/api/klasifikasi/',
                    method: "get"
                })
                .then((result) => {
                    this.klasifikasi = result.data.masters
                }).catch((err) => {

                });
        },
    },
    computed: {
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