<template>
  <v-app id="inspire">
    <v-navigation-drawer
      v-model="drawer"
      :clipped="$vuetify.breakpoint.mdAndUp"
      app color="yellow lighten-1"
    >
      <v-list dense>
        <template v-for="item in items">
        <div v-if="cekdatahak(item.level) == true ">
          <v-layout
            v-if="item.heading"
            :key="item.heading"
            row
            align-center
          >
            <v-flex xs6>
              <v-subheader v-if="item.heading">
                {{ item.heading }}
              </v-subheader>
            </v-flex>
            <v-flex
              xs6
              class="text-xs-center"
            >
              <a
                href="#!"
                class="body-2 black--text"
              >EDIT</a>
            </v-flex>
          </v-layout>
          <v-list-group
            v-else-if="item.children"
            :key="item.text"
            v-model="item.model"
            :prepend-icon="item.model ? item.icon : item['icon-alt']"
            append-icon=""
          >
            <template v-slot:activator>
              <v-list-item link >
                <v-list-item-content>
                  <v-list-item-title>
                    {{ item.text }}
                  </v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </template>
            <v-list-item
              v-for="(child, i) in item.children"
              :key="i"
              @click=""
              :to="child.link"
            >
              <v-list-item-action v-if="child.icon">
                <v-icon>{{ child.icon }}</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title>
                  {{ child.text }}
                </v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list-group>
          <v-list-item
            v-else
            :key="item.text"
            :to="item.link" 
            link
          >
            <v-list-item-action>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>
                {{ item.text }}
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          </div>
        </template>
      </v-list>

      <template v-slot:append>
        <div class="pa-2">
          <v-btn block @click="logout" color="lime darken-1">Logout</v-btn>
        </div>
      </template>
    </v-navigation-drawer>

    <v-app-bar
      :clipped-left="$vuetify.breakpoint.lgAndUp"
      app
      color="yellow lighten-1"
      dark
    >
      <v-app-bar-nav-icon @click.stop="drawer = !drawer" color="lime darken-1"></v-app-bar-nav-icon>
      <v-toolbar-title
        style="width: 300px"
        class="ml-0 pl-4"
      >
        <span class="hidden-sm-and-down black--text">SIM PKB DUMAI</span>
      </v-toolbar-title>
     
      <v-spacer></v-spacer>
      <v-btn
        icon
        large
      >
        <v-avatar
          size="32px"
          item
        >
          <v-img
            src="https://cdn.vuetifyjs.com/images/logos/logo.svg"
            alt="Vuetify"
          ></v-img></v-avatar>
      </v-btn>
    </v-app-bar>
    <v-main>
        <router-view></router-view>
    </v-main>
    
  </v-app>
</template>

<script>
  export default {
    name: 'main-app',
    props: {
      source: String,
    },
    data: () => ({
      dialog: false,
      drawer: null,
      halamanakses:[],
      halaman:[],
      items: [
        { icon: 'mdi-view-dashboard', text: 'Dashboard', link: '/', level : 'admin' },
        { icon: 'mdi-clipboard-list-outline', text: 'Pendaftaran', link: '/admin/pendaftarans', level: '1' },
        { icon: 'mdi-clipboard-list-outline', text: 'DataKendaraan Lama', link: '/admin/pendaftaranolds', level: '1' },
        { icon: 'mdi-clipboard-list-outline', text: 'Datakendaraan', link: '/admin/datakendaraans', level: '7' },
        { icon: 'mdi-content-copy', text: 'Numpang Uji', link: '/admin/numpangs', level: '5' },
        { icon: 'mdi-content-copy', text: 'Mutasi Uji', link: '/admin/mutasi', level: '6' },
        { icon: 'mdi-account-reactivate', text: 'user', link: '/admin/managementuser', level: '13' },
        { icon: 'mdi-fit-to-page', text: 'settingpos', link: '/admin/setting/posuji', level: '9' },
        { icon: 'mdi-fit-to-page', text: 'Setting Amprah', link: '/admin/setting/amprah', level: '14' },
        { icon: 'mdi-content-copy', text: 'Pengujian', link: '/admin/verif', level: '12' },
        { icon: 'mdi-content-copy', text: 'Lulus', link: '/admin/veriflulus', level: '12' },
        { icon: 'mdi-content-copy', text: 'Tidak Lulus', link: '/admin/verifgagal', level: '12' },
        {
          icon: 'mdi-chevron-up',
          'icon-alt': 'mdi-chevron-down',
          text: 'Cetak',
          model: false,
          level: '10',
          children: [
            { 
              icon: 'mdi-notebook-multiple', text: 'Buku Besar',  link: '/admin/bukubesar',
            },
            { 
              icon: 'mdi-book-open', text: 'Laporan', link: '/admin/laporan', 
            },
            { 
              icon: 'mdi-book-open', text: 'Hasil Uji', link: '/admin/hasiluji',
            },
          ],
        },
        { icon: 'mdi-bank-transfer', text: 'Transaksi', link: '/admin/transaksis', level: '2' },
      ],
    }),
    methods: {
      initialize () {
          var id = JSON.parse(localStorage.getItem("user"));
          axios({
                  url: '/api/navakses/'+id.id,
                  method: "GET",
              })
              .then((result) => {
                  this.halaman = result.data.halamanakses
              }).catch((err) => {

              });
          },
      cekdatahak(id){
        return this.halaman.includes(id);
      },
      logout(){
           this.$store.commit('logout');
            window.location.href = '/login';
           
       }
    },
    computed: {

    },
    created() {
        this.initialize();
    },
  }
</script>