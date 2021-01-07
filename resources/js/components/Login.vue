 <template>
  <v-app id="inspire">
    <v-main>
      <v-container
        class="fill-height"
        fluid
      >
        <v-row
          align="center"
          justify="center"
        >
          <v-col
            cols="12"
            sm="8"
            md="4"
          >
            <form @submit.prevent="authenticate">
            <v-card class="elevation-12 yellow lighten-1 text-center">
            <v-card-title >SIM PKB DUMAI</v-card-title>
              <v-card-text>
                  <v-text-field class="white--text"
                    v-model="form.email"
                    label="Login"
                    name="login"
                    prepend-icon="mdi-account"
                    type="text" 
                  ></v-text-field>

                  <v-text-field
                    id="password"
                    v-model="form.password"
                    label="Password"
                    name="password"
                    prepend-icon="mdi-lock"
                    type="password"
                  ></v-text-field>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn type="submit" color="lime darken-1" @click="authenticate" >Login</v-btn>
              </v-card-actions>
            </v-card>
            </form>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import {login} from '../helpers/auth';
  export default {
    props: {
      source: String,
    },
    data: () => ({
        drawer: null,
        form: new Form({
          email: '',
          password: '',
        }),
    }),
    methods: {
      authenticate(){
        this.$store.dispatch("login");
        Swal.showLoading()
        login(this.$data.form)
        .then((res)=>{
          Swal.close()
          this.$store.commit("loginSuccess",res)
            var id = JSON.parse(localStorage.getItem("user"));
            var hostname = window.location.hostname;

            if(id.level == 'Penguji'){
              window.location.href = '/uji/pendaftarans';
            }else if(id.level == 'Verifikator'){
              window.location.href =  '/uji/verif';
            }else if(id.level == 'Retribusi'){
              window.location.href =  '/admin/transaksis';
            }else if(id.level == 'Cetak'){
              window.location.href =  '/admin/hasiluji';
            }else if(id.level == 'Datakendaraan'){
              window.location.href =  '/admin/datakendaraans';
            }else{            
              window.location.href =  '/admin/pendaftarans';
            }
        })
        .catch((error)=>{
          Swal.fire({
            type:'error',
            title:'Ooops',
            text: error
          })
        })
      }
    },
    created() {
    },
  }
</script>