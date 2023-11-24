var app = new Vue({
    el: '#cart',
    data:{
      allData: '',
      //count
      total: 0
    },
    methods: {
      fetchItem:function() {
        axios.post("./cart.php",{

        }).then(function (response) {
            //allDataにSELECT文の結果が配列で格納
            app.allData = response.data;
          });
      },
      //数量を設定する
      increment(id){
        const index = app.getIndexBy(id);
        app.allData[index].quantity++;
        this.total = app.allData[index].quantity * app.allData[index].price;
        
        //phpにデータを送る
        fetch('cart_input.php', {
          method: 'POST',
          headers: {'Content-Type': 'application/json'},  //json指定
          body: JSON.stringify(app.allData[index].quantity) //json形式に変換して送付
        })
        /*.then(response => response.json())
        .then(res => {
          console.log(res);
        });*/
      },
      decrement(id){
        const index = app.getIndexBy(id);
        app.allData[index].quantity--;
        this.total = app.allData[index].quantity * app.allData[index].price
      },
      getIndexBy(id){
        const filteredTodo=app.allData.filter(todo => todo.id === id)[0];
        const index=app.allData.indexOf(filteredTodo);
        return index;
      }
    },
      mounted () {
        // インスタンス初期化時、DOMが生成された後に実行される
        this.fetchItem()
      }
});