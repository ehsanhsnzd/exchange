<template>
  <div>
    <b-container>

      <b-row>
        <b-col md="12">

          <div class="panel default-main -align-center -centercode">
            <b>Trade History</b>
          </div>
          <div class="panel default-main -align-center">
            <b-row>
              <b-col md="2">Fee</b-col>
              <b-col md="2">From/To</b-col>
              <b-col md="4">Amount</b-col>
              <b-col md="2">Submit date</b-col>
            </b-row>
          </div>
          <div class="panel default-main" v-for="history in histories">
            <b-row>
              <b-col md="2">
                {{ history.buy_fee }}
              </b-col>
              <b-col md="2">
                {{ history.buy_currency }}/{{history.sell_currency }}
              </b-col>
              <b-col md="4">
                <div style="background-color: #aed090;text-align: center">
                  {{ history.amount }}
                </div>
              </b-col>
              <b-col md="2">
                {{ history.created }}
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
      histories: [],

    }
  },
  mounted() {
    this.fetchHistory()
  },
  methods: {
    ...mapActions({
      getHistory: actionsTypes.user.HISTORY,
    }),
    async fetchHistory() {
      let {meta, data} = await this.getHistory();
      if (meta.status == 'Success')
        this.histories = data
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
