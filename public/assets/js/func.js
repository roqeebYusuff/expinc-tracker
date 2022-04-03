(function($){

    $(window).on('load', () => {
        $('#preloader').fadeOut()
    })

    fetchAmounts = (url) => {
        $.ajax({
            method: 'POST',
            url: url
        })
        .done( (response) => {
            var data = JSON.parse(response)
            var income = data.income[0].amount ? data.income[0].amount : 0
            var expense = data.expense[0].amount ? data.expense[0].amount : 0
            var total = income - expense
            $('.totalBalance').html(separator(total))
            $('.totalIncome').html(separator(income))
            $('.totalExpense').html(separator(expense))
        })
    }

    separator = (num) => {
        var str = num.toString().split(".")
        str[0] = str[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        return str.join(".")
    }


    incomeEntry = (url) => {
        $('.incomeEntries').empty()
        $.ajax({
            method: 'POST',
            url: url
        })
        .done( (response) => {
            var data = JSON.parse(response)
            if(data.length > 0){
                data.forEach( e => {
                    var entry = `<div class="single-entry">
                                    <div class="d-flex justify-content-between">
                                        <div class="type d-flex align-items-center">
                                            <div class="icon income">
                                                <i class="fa-solid fa-arrows-up-to-line"></i>
                                            </div>
                                        <div class="detail">
                                            <h6>${separator(e.amount)}</h6>
                                            <div class="d-flex">
                                                <span class="category badge rounded-pill bg-light">${e.category}</span>
                                                <span class="date">${moment(e.date_added).format("ll")}</span>
                                            </div>
                                        </div></div><div class="action align-self-center deleteEntry">
                                                <i class="fas fa-trash income" data-id='${e.entry_id}'></i>
                                            </div>
                                        </div>
                                    </div>`
    
                    $('.incomeEntries').append(entry)
                })
            }
            else{
                var entry = `<div class="text-center">
                            <img class="img-fluid emtptyData" src="http://localhost:8080/assets/img/empty.png" alt="">
                            <p class="text-muted">No data available</p>
                            <p class="text-muted opacity-50 m-0">Click the + icon to add a new entry</p>
                        </div>`
                $('.incomeEntries').append(entry)
            }
        })
        .fail( (response) => {
            var entry = `<div class="text-center">
                            <img class="img-fluid" src="http://localhost:8080/assets/img/internet-error.png" alt="" style="height: 50px;>
                            <p class="text-muted">Error fetching Data...Check your internet connection</p>
                        </div>`
            $('.incomeEntries').append(entry)
        })
    }

    expenseEntry = (url) => {
        $('.expenseEntries').empty()
        $.ajax({
            method: 'POST',
            url: url
        })
        .done( (response) => {
            var data = JSON.parse(response)
            if(data.length > 0){
                data.forEach( e => {
                    var entry = `<div class="single-entry">
                                    <div class="d-flex justify-content-between">
                                        <div class="type d-flex align-items-center">
                                            <div class="icon expense">
                                                <i class="fa-solid fa-arrows-down-to-line"></i>
                                            </div>
                                        <div class="detail">
                                            <h6>${separator(e.amount)}</h6>
                                            <div class="d-flex">
                                                <span class="category badge rounded-pill bg-light">${e.category}</span>
                                                <span class="date">${moment(e.date_added).format("ll")}</span>
                                            </div>
                                        </div></div><div class="action align-self-center deleteEntry">
                                                <i class="fas fa-trash expense" data-id='${e.entry_id}'></i>
                                            </div>
                                        </div>
                                    </div>`
    
                    $('.expenseEntries').append(entry)
                })
            }
            else{
                var entry = `<div class="text-center">
                            <img class="img-fluid emtptyData" src="http://localhost:8080/assets/img/empty.png" alt="">
                            <p class="text-muted">No data available</p>
                            <p class="text-muted opacity-50 m-0">Click the + icon to add a new entry</p>
                        </div>`
                $('.expenseEntries').append(entry)
            }
        })
        .fail( (response) => {
            var entry = `<div class="text-center">
                            <img class="img-fluid" src="http://localhost:8080/assets/img/internet-error.png" alt="" style="height: 50px;>
                            <p class="text-muted">Error fetching Data...Check your internet connection</p>
                        </div>`
            $('.expenseEntries').append(entry)
        })
    }
}(jQuery))