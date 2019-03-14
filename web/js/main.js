var app = new Vue({
    el: '#app',
    data: {
        buildingTitle: '',
        buildingCity: '',
        houseTitle: '',
        houses: [],
        houseId: 0,
        apartment: {
            rooms: 'студия',
            square: '',
            typical: true,
            fullPrice: false,
            price: null,
            house_id: null,
            id: 0
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
                this.errors.push("Заполните поле название дома");
            } else {
                this.houses.push({
                    id: this.houseId++,
                    title: this.houseTitle
                });
                this.houseTitle = '';
            }
        },
        onHouseDelete(id) {
            var index = -1;
            this.houses.forEach((house,i) => {
                if (id === house.id) {
                    index = i;
                }
            });
            if (index >= 0) {
                this.houses.splice(index, 1);
            }
            this.deleteReletedApartments(id);
        },
        deleteReletedApartments(house_id) {
            for (var i = this.apartments.length - 1; i >= 0; i--) {
                if(this.apartments[i].house_id === house_id) {
                    this.apartments.splice(i, 1);
                }
            }
        },
        onApartmentDelete(id) {
            var index = -1;
            this.apartments.forEach((apartment, i) => {
                if (id === apartment.id) {
                    index = i;
                }
            })
            if (index >= 0) {
                this.apartments.splice(index,1);
            }
        },
        onApartmentAdd() {
            if (this.apartment.price == null) {
                alert('Заполните поле цена квартиры');
                this.errors.push('Заполните поле цена квартиры');
            } else {
                if (!this.apartment.typical && this.apartment.house_id == null) {
                    alert("Заполните поле дом для не типвой квартиры");
                    this.errors.push("Заполните поле дом для не типвой квартиры");
                } else {
                    this.apartments.push({
                        id: this.apartment.id,
                        rooms: this.apartment.rooms,
                        typical: this.apartment.typical,
                        fullPrice: this.apartment.fullPrice,
                        house_id: this.apartment.house_id,
                        price: this.apartment.price,
                        square: this.apartment.square
                    });
                    this.apartment.rooms = 'студия';
                    this.apartment.square = '';
                    this.apartment.typical = true;
                    this.apartment.fullPrice = false;
                    this.apartment.house_id = null;
                    this.apartment.price = null;
                    this.apartment.id++;
                }
            }
        },
        getHouse(apartment) {
            var title = '';
            this.houses.forEach((house) => {
                if (house.id == apartment.house_id) {
                    title = house.title;
                }
            });
            return title;
        },
        onBuildingSave()
        {
            if (this.buildingTitle == '' || this.buildingCity == '') {
                alert("Заполните поля: название новостройки и город новостройки");
            } else {
                // AJAX QUERY TO SAVING DATA

                $.ajax({
                    type: "POST",
                    url: "/admin/ajax/building/save",
                    data: {
                        building: {
                            title: this.buildingTitle,
                            city: this.buildingCity
                        },
                        houses: this.houses,
                        apartments: this.apartments
                    }
                }).done(function(res) {
                    if (res.error) {
                        document.location.href="/admin/add"
                    } else {
                        document.location.href="/admin/list"
                    }
                }).fail(function() {
                    alert("Произошла ошибка при сохранении даных");
                });
            }
        }
    },
    created() {

    }
})


