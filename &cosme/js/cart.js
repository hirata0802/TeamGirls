new Vue({
    el: '#cart',
    data(){
        return{
            items: []
        };
    },
    methods: {
        increment(){
            this.count++;
        },
        decrement(){
            this.count--;
        }
    },
    computed: {
        isPass: function(){
            return this.count >= 60;
        }
    },
    methods: {
        // 商品一覧をjsonから取得する
        fetchItem () {
          //コールバック関数でthisを参照できないため別変数へ代入
          const self = this
          //axios.get("./item.json").then(function (response) {
          axios.get("./select_all.php").then(function (response) {
            self.items = response.data
          })
          .catch(function(error) {
            self.errorFlag = true;
            alert('ERROR!! 商品一覧が取得できませんでした')
          });
        },
        // タブを切り替えて検索条件を初期化する
        changeTab (number) {
          this.initialize()
          this.activeTab = number
        },
        // 検索条件を初期化する
        initialize () {
          this.filterText = ""
          this.filterPriceId = undefined
        }
      },
      mounted () {
        // アプリケーションが立ち上がったら商品一覧を取得する
        // インスタンス初期化時、DOMが生成された後に実行される
        this.fetchItem()
      }
});