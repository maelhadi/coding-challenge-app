<template>
    <div>
        <form @submit.prevent="addProduct">
        <label>
            Name:
            <input v-model="newProduct.name" type="text" required />
        </label>
        <label>
            Description:
            <input v-model="newProduct.description" type="text" required />
        </label>
        <label>
            Price:
            <input v-model="newProduct.price" type="number" step="0.01" required />
        </label>
        <label>
            Category :
            <select multiple v-model="newProduct.categories">
                <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
            </select>
        </label>
        <label>
            Image:
            <input type="file" ref="fileInput" @change="uploadFile"  required/>
        </label>
        <br>
        <br>
        <button type="submit">Add Product</button>
        <p v-text="error"></p>
        </form>
        <hr>
        <br>
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

        <br/><br/>
        <span>Filter by category :</span>
        <select v-model="selectedCategoryFilter" @change="getProducts">
            <option value="">All categories</option>
            <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
        </select>
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
        column: 'id',
        order: 'asc'
      },
      selectedCategoryFilter: '',
      categories: [],
      newProduct: {
        name: "",
        description: "",
        price: "",
        image: '',
        categories: [],
      },
      error: '',
    }
  },
  mounted() {
    this.getProducts();
    this.getCategories();
  },
  methods: {
    async getProducts(pageNumber) {
      try {
        axios.get('/api/products?page='+pageNumber+
                                            '&column='+this.sort.column+
                                            '&order='+this.sort.order+
                                            '&category='+this.selectedCategoryFilter)
                .then(response => {
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
    getCategories() {
        try{
            axios.get('/api/categories').then(response => {
                this.categories = response.data;
            });
        } catch (error) {
            console.log(error);
        }
    },
    addProduct() {
      axios
        .post('/api/products', this.newProduct)
        .then(response => {
          // clear the newProduct object
          this.newProduct = {
                            name: "",
                            description: "",
                            price: "",
                            image: '',
                            categories: [],
                        };

            // clear file input 
            this.$refs.fileInput.value = "";

            //refresh product table
            this.getProducts();
        })
        .catch(error => {
          console.log(error);
        });
    },
    uploadFile(event) {
        let formData = new FormData();
        formData.append('image', event.target.files[0]);

      axios
        .post('/api/products/upload', formData, {headers: {'Content-Type': 'multipart/form-data'}})
        .then(response => {
            // check errors
            if(typeof response.data.error !== "undefined"){
                this.error = response.data.error;
                this.$refs.fileInput.value = "";
            }else{
                this.newProduct.image = response.data.url;
                this.error = "";
            }
        })
        .catch(error => {
          console.log(error);
        });
    },
  }
  
}
</script>
