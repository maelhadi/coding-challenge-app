<template>
    <div>
        <table>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
            </tr>
            <tr>
                <td>
                    <button @click="sortBy('name', 'asc')">Asc</button>
                    <button @click="sortBy('name', 'desc')">Desc</button>
                </td>
                <td></td>
                <td>
                    <button @click="sortBy('price', 'asc')">Asc</button>
                    <button @click="sortBy('price', 'desc')">Desc</button>
                </td>
                <td></td>
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
      sort: {
        column: 'name',
        order: 'asc'
      }
    }
  },
  mounted() {
    this.getProducts();
  },
  methods: {
    async getProducts(pageNumber) {
      try {
        axios.get('/api/products?page='+pageNumber+
                                            '&column='+this.sort.column+
                                            '&order='+this.sort.order)
                .then(response => {
            console.log(response.data.data);
            this.products = response.data.data;
            this.totalPages = response.data.last_page;
        });
      } catch (error) {
        console.log(error);
      }
    },
    sortBy(column, order) {
        this.sort.column = column;
        this.sort.order = order;
        this.getProducts();
    },
  }
  
}
</script>
