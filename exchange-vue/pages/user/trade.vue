<template>
  <div>
    <b-container>

      <b-row>
        <b-col md="6">
          <div class="panel default-main -align-center">
            <b-row>
              <b-col md="6">
                <b-input type="text" v-model="buy.fee" class="form-control"  placeholder="Fee"/>
              </b-col>
              <b-col md="6">
                <b-input type="text" v-model="buy.amount" class="form-control"  placeholder="Amount"/>
              </b-col>
            </b-row>
            <b-row>
                <b-col md="12">
                  <button type="submit" @click="callBuy" class="mt-3 w-100 btn btn-primary card-img-right">BUY</button>
                </b-col>
            </b-row>
          </div>
          <div class="panel default-main -align-center">
            <b>Buys</b>
          </div>
          <div class="panel default-main -align-center">
            <b-row>
              <b-col md="8">Fee</b-col>
              <b-col md="4">Amount</b-col>
            </b-row>
          </div>
          <div class="panel default-main" v-for="data in buys">
            <b-row>
              <b-col md="8">
                {{ data.fee }} |
              </b-col>
              <b-col md="4">
                <div style="background-color: #c2e59c;text-align: center">
                  {{ data.amount }}
                </div>
              </b-col>
            </b-row>
          </div>
        </b-col>
        <b-col md="6">
          <div class="panel default-main -align-center">
            <b-row>
              <b-col md="6">
                <b-input type="text" v-model="sell.fee" class="form-control"  placeholder="Fee"/>
              </b-col>
              <b-col md="6">
                <b-input type="text" v-model="sell.amount" class="form-control"  placeholder="Amount"/>
              </b-col>
            </b-row>
            <b-row>
              <b-col md="12">
                <button type="submit" @click="callSell"  class="mt-3 w-100 btn btn-danger card-img-right">SELL</button>
              </b-col>
            </b-row>
          </div>

          <div class="panel default-main -align-center -centercode">
            <b>Sells</b>
          </div>
          <div class="panel default-main -align-center">
            <b-row>
              <b-col md="8">Fee</b-col>
              <b-col md="4">Amount</b-col>
            </b-row>
          </div>
          <div class="panel default-main" v-for="data in sells">
            <b-row>
              <b-col md="8">
                {{ data.fee }} |
              </b-col>
              <b-col md="4">
                <div style="background-color: #f5bcbc;text-align: center">
                  {{ data.amount }}
                </div>
              </b-col>
            </b-row>
          </div>
        </b-col>
      </b-row>


    </b-container>
  </div>
</template>
<script>

import {mapActions} from "vuex";
import actionsTypes from '~/utils/store/actionTypes'

export default {
  data() {
    return {
      buys: [],
      sells: [],
      buy: {},
      sell: {},
      q:{}
    }
  },
  computed: {
    refresh() {
      return this.$route.query;
    }
  },
  watch: {
    refresh() {
      window.location.reload()
    }
  },
  mounted() {
    this.fetchBuys()
    this.fetchSells()
    this.buys = []
    this.sells = []
  },
  methods: {
    ...mapActions({
      getBuys: actionsTypes.user.BUY,
      getSells: actionsTypes.user.SELL,
      setBuy: actionsTypes.user.SET_BUY,
      setSell: actionsTypes.user.SET_SELL,
    }),
    async fetchBuys() {
      let query = {
        from: this.$route.query.from,
        to: this.$route.query.to
      }
      let {meta, data} = await this.getBuys(this.$route.query);
      if (meta.status == 'Success')
        this.buys = data
    },
    async fetchSells() {
      let {meta, data} = await this.getSells(this.$route.query);
      if (meta.status == 'Success')
        this.sells = data
    }  ,
    async callBuy() {
      let query = {
        from: this.$route.query.from,
        to: this.$route.query.to,
        amount:this.buy.amount,
        fee:this.buy.fee,
        currency_id: this.$route.query.from,
      }
      let {meta, data} = await this.setBuy(query);
      // if (meta.status == 'Success')
      this.$toast.success(meta.msg)


      setTimeout(()=>{
        this.fetchSells()
        this.fetchBuys()
      },5000)
    } ,
    async callSell() {
      let query = {
        from: this.$route.query.from,
        to: this.$route.query.to,
        amount:this.sell.amount,
        fee:this.sell.fee,
        currency_id: this.$route.query.to,
      }
      let {meta, data} = await this.setSell(query);
      // if (meta.status == 'Success')
      this.$toast.success(meta.msg)

      setTimeout(()=>{
        this.fetchBuys()
        this.fetchSells()
      },5000)

    }
  }
}
</script>

<style>
.default-main {
  background-color: #f7f7f7;
  border-radius: 4px;
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
