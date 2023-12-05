var app = new Vue({
  el: '#cart',
  data:{
    allData: [],
    filterData: [],
    total: 0
  },
  methods: {
    fetchItem:function(){
      axios.post("./cart.php",{
        
      }).then(function(response){
        //allDataにSELECT文の結果が配列で格納
        app.total = response.data.pop();
        app.allData = response.data;
        app.filterData = app.allData.filter(data => data.delete_flag === 0);
      });
    },
    //数量を設定する
    increment(id){
      const index = app.getIndexBy(id);
      app.allData[index].quantity++;
      this.total += app.allData[index].price;
    },
    decrement(id){
      const index = app.getIndexBy(id);
      app.allData[index].quantity--;
      this.total -= app.allData[index].price;
    },
    cartDelete(id){
      const index = app.getIndexBy(id);
      app.allData[index].delete_flag = 1;
      this.total -= app.allData[index].price*app.allData[index].quantity;
      app.filterData = app.allData.filter(data => data.delete_flag === 0);
    },
    nextOrder(){
        axios.post('./cart_next.php', app.allData)
        .then(response => {
          console.log(response);
          window.location.href="./order.php";
        })
      },
      nextHome(){
        axios.post('./cart_next.php', app.allData)
        .then(response => {
          console.log(response);
          window.location.href="./home.php";
        })
      },
      nextSearch(){
        axios.post('./cart_next.php', app.allData)
        .then(response => {
          console.log(response);
          window.location.href="./seach_input.php";
        })
      },
      nextFavorite(){
        axios.post('./cart_next.php', app.allData)
        .then(response => {
          console.log(response);
          window.location.href="./favorite_show.php";
        })
      },
      nextCart(){
        axios.post('./cart_next.php', app.allData)
        .then(response => {
          console.log(response);
          window.location.href="./cart.php";
        })
      },
      nextMypage(){
        axios.post('./cart_next.php', app.allData)
        .then(response => {
          console.log(response);
          window.location.href="./mypage.php";
        })
      },
      getIndexBy(id){
        const index = app.allData.findIndex(data => data.cart_id === id);
        return index;
      }
    },
    mounted () {
      // インスタンス初期化時、DOMが生成された後に実行される
      this.fetchItem()
    },
  });