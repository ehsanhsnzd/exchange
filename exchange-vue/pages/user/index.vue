<template>
<div >
  <b-container>


          <div class="panel default-main" v-for="balance in user">
            <div >
              {{balance.currency}} Balance : {{ Number.parseFloat(balance.user_balance ).toFixed(2)}}
            </div>
          </div>


  </b-container>
</div>
</template>
<script>

import {mapActions} from "vuex";
import actionsTypes from '~/utils/store/actionTypes'

export default {
  data() {
    return {
      user:[]
    }
  },
  mounted() {
  this.balance()
    },
  methods:{
    ...mapActions({
      getBalance: actionsTypes.user.BALANCE,
    }),
    async balance(){
      let {meta,data} = await this.getBalance();
        if(meta.status == 'Success')
          this.user = data
    }
  }
}
</script>

<style>
.default-main{
  background-color: #f7f7f7;
  border-radius: 4px ;
  padding: 5px;
  margin: 3px;
}
.vertical-nav {
  min-width: 17rem;
  width: 17rem;
  height: 100vh;
  position: fixed;
  top: 0;
  left: 0;
  box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.1);
  transition: all 0.4s;
}

.page-content {
  width: calc(100% - 17rem);
  margin-left: 17rem;
  transition: all 0.4s;
}

/* for toggle behavior */

#sidebar.active {
  margin-left: -17rem;
}

#content.active {
  width: 100%;
  margin: 0;
}

@media (max-width: 768px) {
  #sidebar {
    margin-left: -17rem;
  }
  #sidebar.active {
    margin-left: 0;
  }
  #content {
    width: 100%;
    margin: 0;
  }
  #content.active {
    margin-left: 17rem;
    width: calc(100% - 17rem);
  }
}

/*
*
* ==========================================
* FOR DEMO PURPOSE
* ==========================================
*
*/

body {
  background: #599fd9;
  background: -webkit-linear-gradient(to right, #599fd9, #c2e59c);
  background: linear-gradient(to right, #599fd9, #c2e59c);
  min-height: 100vh;
  overflow-x: hidden;
}

.separator {
  margin: 3rem 0;
  border-bottom: 1px dashed #fff;
}

.text-uppercase {
  letter-spacing: 0.1em;
}

.text-gray {
  color: #aaa;
}
</style>
