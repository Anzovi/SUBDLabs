@extends('sample')

@section('title')Главная страница@endsection

@section('content')

    <div id="MainPage">
        <v-app>
            <v-main>
                <v-card>
                    <v-card-text>
                        <v-data-table
                            :headers="headers"
                            :items="show_tables_info"
                            class="elevation-1"
                            :search="search">
                            <template v-slot:top>
                                <v-text-field
                                    v-model="search"
                                    label="Поиск"
                                    class="mx-4"
                                >
                                </v-text-field>
                            </template>
                            <template
                                v-slot:item._actions="{ item }">
                                <v-btn
                                    icon @click = "ShowDialogChange(item)">
                                    <v-icon>
                                        mdi-pencil
                                    </v-icon>
                                </v-btn>
                                <v-btn icon @click = "ShowDialogDelete(item)">
                                    <v-icon>
                                        mdi-delete
                                    </v-icon>
                                </v-btn>
                            </template>
                            <!--<template v-slot:footer.page-text>
                                <v-btn
                                    color="primary"
                                    dark
                                    class="ma-2"
                                    @click="buttonCallback">
                                    Button
                                </v-btn>
                            </template>-->

                        </v-data-table>

                    </v-card-text>

                    <v-card-actions>
                        <v-btn
                            block
                            depressed
                            class="transparent font-weight-bold grey--text pa-2 d-flex align-center"
                            icon @click="ShowDialogAdd()"
                        >
                            <v-icon>
                                mdi-plus
                            </v-icon>
                            <span>
                                Добавить запсиь
                            </span>
                        </v-btn>


                    </v-card-actions>

                    <!--NEW CODE-->
                    <v-text-field
                        v-model="Date_1"
                        label="Поиск от"
                        class="mx-4"
                    ></v-text-field>
                    <v-text-field
                        v-model="Date_2"
                        label="Поиск до"
                        class="mx-4"
                    ></v-text-field>

                    <v-btn
                        color="primary"
                        text
                        @click="filterTable()"
                    >Отфильтровать</v-btn>



                    <v-btn
                        color="primary"
                        text
                        @click="showStats = true"
                    >Расчитать статистические характеристики</v-btn>
                    <!--NEW CODE-->
                </v-card>


            </v-main>

            <v-dialog
                v-model="dialog_change"
                width="400"
            >
                <v-card>
                    <v-card-title class="text-h5 grey lighten-2">
                        Изменение данных
                    </v-card-title>
                    <v-divider></v-divider>
                    <v-card-actions>
                        <v-col>
                            <v-col
                                cols="auto"
                                sm="50"
                                md="10"
                            >
                                <v-text-field
                                    v-model="Kod"
                                    label="Код"
                                    class="mx4"
                                    disabled>
                                </v-text-field>
                            </v-col>
                            <v-col
                                ccols="auto"
                                sm="50"
                                md="10"
                            >
                                <v-text-field
                                    v-model="Exec_data"
                                    label="Дата погошения"
                                    class="mx4"
                                    disabled>

                                </v-text-field>
                            </v-col>
                            <v-col
                                cols="auto"
                                sm="50"
                                md="10"
                            >
                                <v-text-field
                                    v-model="Torg_date"
                                    label="Дата торгов"
                                    class="mx4"
                                    disabled>

                                </v-text-field>
                            </v-col>
                            <v-col
                                cols="auto"
                                sm="50"
                                md="10"
                            >
                                <v-text-field
                                    v-model="Quotation"
                                    label="Максимальная цена"
                                    class="mx4">

                                </v-text-field>
                            </v-col>
                            <v-col
                                cols="auto"
                                sm="50"
                                md="10"
                            >
                                <v-row>
                                    <v-text-field
                                        v-model="Num_contr"
                                        label="Кол-во продаж"
                                        class="mx4">
                                    </v-text-field>
                                    <v-col>
                                        <v-btn
                                            color="primary"
                                            text
                                            @click="ChangeData"
                                        >
                                            Изменить
                                        </v-btn>
                                        <v-btn
                                            color="primary"
                                            text
                                            @click="dialog_change = false"
                                        >
                                            Отмена
                                        </v-btn>
                                    </v-col>
                                </v-row>
                            </v-col>

                        </v-col>

                    </v-card-actions>
                </v-card>
            </v-dialog>

            <v-dialog
                v-model="dialog_delete"
                width="400"
            >
                <v-card>
                    <v-card-title class="text-h5 grey lighten-2">
                        Удаление данных
                    </v-card-title>

                    <v-divider></v-divider>
                    <v-card-text>
                        Вы точно уверены?
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>

                        <v-divider></v-divider>

                        <v-btn
                            color="primary"
                            text
                            icon @click="DeleteData"
                        >
                            удалить
                        </v-btn>

                        <v-spacer></v-spacer>


                        <v-btn
                            color="primary"
                            text
                            @click="dialog_delete = false"
                        >
                            Отмена
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <v-dialog
                v-model="dialog_add"
                width="400">
                <v-card>
                    <v-card-title class="text-h5 grey lighten-2">
                        Изменение данных
                    </v-card-title>
                    <v-divider></v-divider>
                    <v-card-actions>
                        <v-col>
                            <v-col
                                cols="auto"
                                sm="50"
                                md="10"
                            >
                                <v-text-field
                                    v-model="Kod"
                                    label="Код"
                                    class="mx4"
                                >
                                </v-text-field>
                            </v-col>
                            <!--<v-col
                                ccols="auto"
                                sm="50"
                                md="10"
                            >
                                <v-text-field
                                    v-model="Exec_data"
                                    label="Дата погошения"
                                    class="mx4"
                                    >
                                </v-text-field>
                            </v-col>-->
                            <v-col
                                cols="auto"
                                sm="50"
                                md="10"
                            >
                                <v-text-field
                                    v-model="Torg_date"
                                    label="Дата торгов"
                                    class="mx4"
                                >

                                </v-text-field>
                            </v-col>
                            <v-col
                                cols="auto"
                                sm="50"
                                md="10"
                            >
                                <v-text-field
                                    v-model="Quotation"
                                    label="Максимальная цена"
                                    class="mx4">

                                </v-text-field>
                            </v-col>
                            <v-col
                                cols="auto"
                                sm="50"
                                md="10"
                            >
                                <v-row>
                                    <v-text-field
                                        v-model="Num_contr"
                                        label="Кол-во продаж"
                                        class="mx4">
                                    </v-text-field>
                                    <v-col>
                                        <v-btn
                                            color="primary"
                                            text
                                            @click="AddData()"
                                        >
                                            Добавить
                                        </v-btn>
                                        <v-btn
                                            color="primary"
                                            text
                                            @click="dialog_add = false"
                                        >
                                            Отмена
                                        </v-btn>
                                    </v-col>
                                </v-row>
                            </v-col>

                        </v-col>

                    </v-card-actions>
                </v-card>
            </v-dialog>

        <!--NEW CODE-->
            <v-dialog
                v-model="showStats"
                width="1000"
            >
                <v-card>
                    <v-card-title class="text-h5 grey lighten-2">
                        Статистика
                    </v-card-title>



                    <v-card-actions>


                        <v-data-table
                            :headers="headersStats"
                            :items="Stats"
                            class="elevation-1"
                            :search="search">
                            <template v-slot:top>
                                <v-text-field
                                    v-model="search"
                                    label="Поиск"
                                    class="mx-4"
                                >
                                </v-text-field>
                            </template>
                        </v-data-table>


                        <v-btn
                            color="primary"
                            text
                            @click="showStatsFun()"
                        >
                            Рассчитать
                        </v-btn>


                        <v-btn
                            color="primary"
                            text
                            @click="showStats = false"
                        >
                            Отмена
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <!--NEW CODE-->
        </v-app>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>
        new Vue({
            el: '#MainPage',
            vuetify: new Vuetify(),
            data(){
                return{
                    //selected:[],
                    //show_tables_info_:[],
                    show_tables_info:[],//информация в таблице
                    show_tables_info_original:[],
                    dialog_change: false,//диалог на изменение
                    dialog_delete: false,//диалог на удаление
                    dialog_add: false,//диалог на добаление
                    showStats: false,
                    search: '',//поиск
                    Kod:'',
                    Exec_data:'',
                    Torg_date:'',
                    Quotation:'',
                    Num_contr:'',

                    Date_1:'',
                    Date_2:'',

                    Stats:[],


                    headers: [
                        {
                            text: 'Код фьючерса',
                            align: 'start',
                            value: 'kod',
                        },
                        { text: 'Дата погашения', value: 'exec_data' },
                        { text: 'Дата торгов', value: 'torg_date' },
                        { text: 'Максимальная цена', value: 'quotation' },
                        { text: 'Кол-во продаж', value: 'num_contr' },
                        { text: 'Изменить/удалить', value: '_actions'},
                    ],
                    headersStats: [
                        { text: 'FUSD', value: 'FUSD' },
                        { text: 'Mx', value: 'Mx' },
                        { text: 'D', value: 'D' },
                        { text: 'V', value: 'V' },
                        { text: 'TrendMx', value: 'TrendMx'},
                        { text: 'TrendD', value: 'TrendD'},
                    ],
                }
            },
            methods:{
                //<!--NEW CODE-->
                showStatsFun(){
                    this.Stats = []
                    let groupBy = function(xs, key) {
                        return xs.reduce(function(rv, x) {
                            (rv[x[key]] = rv[x[key]] || []).push(x);
                            return rv;
                        }, {});
                    };



                    let t = this.show_tables_info
                    let t_0 = this.show_tables_info.slice(0, -2)

                    let groupByFUSD_t = groupBy(t, 'kod')
                    let groupByFUSD_t_0 = groupBy(t_0, 'kod')


                    //Нахождение среднего для двух периодов, max, min
                    let temp_average_t = [];

                    //let temp_min_t = [];
                    //let temp_max_t = [];
                    let temp_d_t = [];
                    let temp_diff_t = [];


                    let temp_average_t_0 = [];
                    let temp_diff_t_0 = [];
                    //let temp_min_t_t_0 = [];
                    //let temp_max_t_t_0 = [];
                    let temp_FUSD = [];

                    let temp_average_all = [];
                    let temp_diff_all = [];

                    let d;

                    //Тут можно много чего оптимизировать
                    for (let key in groupByFUSD_t) {
                        //console.log(key, groupByFUSD_t[key]);
                        let average = groupByFUSD_t[key].reduce((total, next) => total + parseFloat(next.quotation), 0) / groupByFUSD_t[key].length;

                        let diff = groupByFUSD_t[key].reduce((total, next) => total + (parseFloat(next.quotation) - average)*(parseFloat(next.quotation) - average), 0) / (groupByFUSD_t[key].length-1);


                        //Получение минимума для данного фьючерса
                        /*console.log('min',groupByFUSD_t[key].reduce(function(prev, curr) {
                            return prev.quotation < curr.quotation ? prev : curr;
                        }).quotation)*/
                        /*temp_min_t.push(groupByFUSD_t[key].reduce(function(prev, curr) {
                            return prev.quotation < curr.quotation ? prev : curr;
                        }).quotation);*/

                        //Получение максимума для данного фьючерса
                        /*console.log('max',groupByFUSD_t[key].reduce(function(prev, curr) {
                            return prev.quotation < curr.quotation ? curr : prev;
                        }).quotation)*/
                        /*temp_max_t.push(groupByFUSD_t[key].reduce(function(prev, curr) {
                            return prev.quotation < curr.quotation ? curr : prev;
                        }).quotation)*/

                        //Расчёт размаха max - min
                        d = parseFloat(groupByFUSD_t[key].reduce(function(prev, curr) {
                            return prev.quotation < curr.quotation ? curr : prev;
                        }).quotation) - parseFloat(groupByFUSD_t[key].reduce(function(prev, curr) {
                            return prev.quotation < curr.quotation ? prev : curr;
                        }).quotation)

                        //console.log('d',d)
                        //Добавление размаха
                        temp_d_t.push(d)

                        temp_diff_t.push(diff)

                        //Внесение среднего в массив
                        temp_average_t.push(average)
                        //console.log('average', average)
                        //console.log('diff', diff)
                    }

                    for (let key in groupByFUSD_t_0) {
                        //console.log(key, groupByFUSD_t_0[key]);
                        //console.log(key, groupByFUSD_t_0[key]);
                        temp_FUSD.push(key)
                        let average = groupByFUSD_t_0[key].reduce((total, next) => total + parseFloat(next.quotation), 0) / groupByFUSD_t_0[key].length;
                        let diff = groupByFUSD_t_0[key].reduce((total, next) => total + (parseFloat(next.quotation) - average)*(parseFloat(next.quotation) - average), 0) / (groupByFUSD_t_0[key].length-1);

                        //let sum = (prev, cur) => ({height: prev.height + cur.height});
                        //let avg = arr.reduce(sum).height / arr.length;

                        temp_diff_t_0.push(diff)
                        temp_average_t_0.push(average)

                        //console.log('average', average)
                        //console.log('diff', diff)

                        //console.log('average', average);
                    }

                    for (let i = 0; i < temp_FUSD.length; i++) {

                        //console.log(temp_FUSD[i]);
                        //console.log("d",temp_d_t[i]);
                        //temp_average_all.push(temp_average_t[i] - temp_average_t_0[i])
                        //temp_diff_all.push(temp_diff_t[i] - temp_diff_t_0[i])
                        //console.log("temp_average_all",temp_average_t[i] - temp_average_t_0[i])
                        //console.log("temp_diff_all",temp_diff_t[i] - temp_diff_t_0[i])
                        let props = [
                            ['FUSD', temp_FUSD[i]],
                            ['Mx', Number(temp_average_t[i]).toFixed(3)],
                            ['D', Number(temp_diff_t[i]).toFixed(3)],
                            ['V', Number(temp_d_t[i]).toFixed(3)],
                            ['TrendMx', Number(temp_average_t[i] - temp_average_t_0[i]).toFixed(3)],
                            ['TrendD', Number(temp_diff_t[i] - temp_diff_t_0[i]).toFixed(3)],
                        ]

                        this.Stats.push(Object.fromEntries(props))
                    }

                        /*
                        Mx:[],
                        D:[],
                        v:[],
                        TrendMx:[],
                        TrendD:[],
                        */

                    //console.log(temp_average_t)
                    //console.log(temp_average_t_0)

                    //const average = t.reduce((a, b) => a + b, 0) / t.length;
                },
                filterTable(){

                    this.show_tables_info = this.show_tables_info_original
                    if (this.Date_1 != '' && this.Date_2 != ''){
                        temp = this.show_tables_info.filter(dates => dates.torg_date >= this.Date_1 && dates.torg_date <= this.Date_2);
                        this.show_tables_info = temp/*
                    }else{
                        this.show_tables_info = this.show_tables_info_original*/
                    }

                    //this.users = temp

                    //console.log(temp)
                },
                //<!--NEW CODE-->
                ShowUnitedTable(){//Запрос на данные из таблиц
                    this.show_tables_info_ = []
                    fetch('ShowUnitedTable',{
                        method: 'GET',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                    })
                        .then((response)=>{
                            return response.json()
                        })
                        .then((data)=>{
                            this.show_tables_info = data
                            this.show_tables_info_original = this.show_tables_info

                        })
                },
                ShowDialogAdd(){/*Диалог на добаление*/
                    this.Kod=''
                    this.Exec_data=''
                    this.Torg_date=''
                    this.Quotation=''
                    this.Num_contr=''
                    this.dialog_add=true
                },
                ShowDialogChange(item){//диалог на измение
                    this.Kod=item.kod
                    this.Exec_data=item.exec_data
                    this.Torg_date= item.torg_date
                    this.Quotation=Number(item.quotation)
                    this.Num_contr=Number(item.num_contr)
                    this.item=item
                    this.dialog_change=true
                },
                ShowDialogDelete(item){//диалог на удаление
                    this.Kod=item.kod
                    this.Torg_date= item.torg_date
                    this.item=item
                    this.dialog_delete=true
                },
                ChangeData(){//Изменение данных
                    let data=new FormData()
                    data.append('kod',this.Kod)
                    data.append('torg_date',this.Torg_date)
                    data.append('quotation',this.Quotation)
                    data.append('num_contr',this.Num_contr)
                    fetch('ChangeData',{
                        method:'post',
                        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        body:data
                    })
                        .then((response)=>{
                            this.ShowUnitedTable();
                        })

                    this.dialog_change=false;
                },
                DeleteData(){//удаление данных
                    let data=new FormData()
                    data.append('kod',this.Kod)
                    data.append('torg_date',this.Torg_date)
                    fetch('DeleteData',{
                        method:'post',
                        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        body:data
                    })
                    this.ShowUnitedTable();
                    this.dialog_delete=false;
                },
                AddData(){
                    let data=new FormData()
                    data.append('kod','FUSD_'+this.Kod)
                    //data.append('exec_data',this.Exec_data)//Убрать только код сделать
                    data.append('torg_date',this.Torg_date)
                    data.append('quotation',this.Quotation)
                    data.append('num_contr',this.Num_contr)
                    fetch('AddData',{
                        method:'post',
                        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        body:data
                    })
                    this.ShowUnitedTable();
                    this.dialog_add=false;
                },
            },
            mounted: function (){//предзапуск функций
                this.ShowUnitedTable();
            }
        })
    </script>

@endsection
