<template>
    <div>
        <table>
            <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            </tr>
            <tr v-for="product in products" >
            <td>{{ product.name }}</td>
            <td>{{ product.description }}</td>
            <td>{{ product.price }}</td>
            </tr>
        </table>
        <br/>
        <div>
            Pages: 
            <button v-for="pageNumber in totalPages" @click="getProducts(pageNumber)">{{ pageNumber }}</button>
        </div>
    </div>

</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      products: [],
      totalPages: 1,
    }
  },
  mounted() {
    this.getProducts();
  },
  methods: {
    async getProducts(pageNumber) {
      try {
        axios.get('/api/products?page='+pageNumber)
                .then(response => {
            console.log(response.data.data);
            this.products = response.data.data;
            this.totalPages = response.data.last_page;
        });
      } catch (error) {
        console.log(error);
      }
    },
  }
  
}
</script>
