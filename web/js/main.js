var app = new Vue({
    el: '#app',
    data: {
        houseTitle: '',
        houses: [],
        houseId: 0,
        apartment: {
            rooms: 'студия',
            square: '',
            typical: true,
            fullPrice: false,
            price: null
        },
        apartments: []
    },
    computed: {
      typical() {
          return Boolean(this.apartment.typical);
      }
    },
    methods: {
        onHouseAdd() {
            if (this.houseTitle === '') {
                alert("Заполните поле название дома");
            } else {
                this.houses.push({
                    id: this.houseId++,
                    title: this.houseTitle
                });
                this.houseTitle = '';
            }
        },
        onHouseDelete(id) {
            var index = 0;
            this.houses.forEach((house,i) => {
                if (id === house.id) {
                    index = i;
                }
            });
            this.houses.splice(index, 1);
        },
        func()
        {
            // alert(this.apartment.typical);
        }
    },
    created() {

    }
})


