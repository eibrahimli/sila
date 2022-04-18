<template>
  <div class="row">
    <div class="col-md-12">
      <div class="card m-b-30">
        <div class="card-header">
          <h5 class="m-b-0">
            <i class="mdi mdi-checkbox-intermediate"></i> Nəticələr
          </h5>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover align-td-middle">
              <thead>
                <tr>
                  <th>Ad</th>
                  <th>Soyad</th>
                  <th>Adres</th>
                  <th>Nömrə</th>
                  <th>Ədəd</th>
                  <th>Məbləğ</th>
                  <th>Üsul</th>
                  <th>Ödəmə</th>
                  <th>Aktİv Et</th>
                  <th>Ayarlar</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(order, index) in orders.data" :key="index">
                  <td>{{ order.name }}</td>
                  <td>{{ order.surname }}</td>
                  <td> {{ order.adress }} </td>
                  <td> {{ order.number }} </td>
                  <td> {{ order.total_quantity }} </td>
                  <td> {{ order.total_price }} </td>
                  <td> {{ order.payment_method }} </td>
                  <td> {{ order.paid ? 'Var' : 'Yox' }} </td>
                  
                  <td>
                    <label class="cstm-switch">
                      <input
                        type="checkbox"     
                        @change.prevent="checked($event,order.id)"                   
                        class="cstm-switch-input"
                      />
                      <span class="cstm-switch-indicator bg-success"></span>
                      
                    </label>
                  </td>         
                  <td class="text-center">
                    <a :href="`${base_url}/admin/order/${order.id}`" class="text-center"><i class="icon-placeholder mdi mdi-eye"></i></a>
                    <a href="javascript:void(0)" @click.prevent="deleteOrder(order.id)" class="text-center remove-category"><i class="icon-placeholder mdi mdi-delete mdi-18px"></i></a>                      
                  </td>         
                </tr>
              </tbody>
            </table>
          </div>
          <div
            v-if="orders.total > orders.per_page"
            class="d-flex justify-content-center"
          >
            <pagination
              :data="orders"
              @pagination-change-page="getResults"
            ></pagination>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["get_not_active_orders"],
  data() {
    return{
        orders: {},
        base_url: Laravel.base_url
    }
  },
  mounted() {
    axios
      .get(this.get_not_active_orders)
      .then((res) => (this.orders = res.data.orders));
  },
  methods: {
    getResults(page = 1) {
      axios
        .get(this.get_not_active_orders + "?page=" + page)
        .then((response) => {
          this.orders = response.data.orders;
        });
    },
    deleteOrder(id) {
      Swal.fire({
        title: "Sifariş silinir.",
        html: `
            <div class="d-flex justify-content-center">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            `,
        showConfirmButton: false,
      });
      axios.delete(`${Laravel.base_url}/admin/order/${id}`, {
        _method: 'DELETE',        
      })
      .then(res => {
        Swal.fire({
          position: "center",
          icon: "success",
          title: res.data.mes,
          showConfirmButton: false,
          timer: 1500,
        });
        
        this.orders = res.data.orders
      })
      .catch(error => {
        Swal.fire({
          position: "center",
          icon: "error",
          title: error.response.data.mes,
          showConfirmButton: false,
          timer: 1500,
        });
      })
    },
    checked($event,id) {
      Swal.fire({
        title: "Sifariş aktiv edilir.",
        html: `
            <div class="d-flex justify-content-center">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            `,
        showConfirmButton: false,
      });
      axios.patch(`${Laravel.base_url}/admin/order/active/${id}`, {
        _method: 'PATCH', 
        id: id       
      })
      .then(res => {
        Swal.fire({
          position: "center",
          icon: "success",
          title: res.data.mes,
          showConfirmButton: false,
          timer: 1500,
        });
        
        this.orders = res.data.orders
        setTimeout(() => {
          $event.target.checked = false
        },1500)
      })
      .catch(error => {
        Swal.fire({
          position: "center",
          icon: "error",
          title: error.response.data.mes,
          showConfirmButton: false,
          timer: 1500,
        });
      })
    }
  },
};
</script>