var app = new Vue({
    el: '#cart',
    data:{
      allData: '',
      total: 0
    },
    methods: {
      fetchItem:function(){
        axios.post("./cart.php",{

        }).then(function(response){
            //allDataにSELECT文の結果が配列で格納
            app.allData = response.data;
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
        this.total -= app.allData[index].price
      },
      cartUpdate(id){
        const index = app.getIndexBy(id);
        fetch('cart_input.php', {
          method: 'POST',
          headers: {'Content-Type': 'application/json'},  //json指定
          body: JSON.stringify(app.allData[index]) //json形式に変換して送付
        }).then(function(response){
          //allDataにSELECT文の結果が配列で格納
          app.allData = response.data;
        });
      },
      cartDelete(id){
        const index = app.getIndexBy(id);
        fetch('cart_delete.php', {
          method: 'POST',
          headers: {'Content-Type': 'application/json'},  //json指定
          body: JSON.stringify(app.allData[index]) //json形式に変換して送付
        }).then(function(response){
          //allDataにSELECT文の結果が配列で格納
          app.allData = response.data;
        });

      },
      getIndexBy(id){
        //const filteredTodo=app.allData.filter(todo => todo.id === id)[0];
        //const index=app.allData.indexOf(filteredTodo);
        const index = app.allData.findIndex(data => data.cart_id === id);
        return index;
      }
    },
      mounted () {
        // インスタンス初期化時、DOMが生成された後に実行される
        this.fetchItem()
      }
});