<?php $id = $user->user_id ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard - ExpInc Tracker</title>

        <link rel="shortcut icon" href="<?php echo base_url('assets') ?>/img/favicon.svg" type="image/x-icon">

        <link rel="stylesheet" href="<?php echo base_url('assets') ?>/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo base_url('assets') ?>/css/main.css">
        <link rel="stylesheet" href="<?php echo base_url('assets') ?>/fontawesome/css/all.css">
        <link rel="stylesheet" href="<?php echo base_url('assets') ?>/css/iziToast.min.css">
        <link rel="stylesheet" href="<?php echo base_url('assets') ?>/css/perfect-scrollbar.css">

        <script src="<?php echo base_url('assets') ?>/js/moment.min.js"></script>
    </head>

    <body class="position-relative">
        <div id="preloader">
            <div class="d-flex align-items-center justify-content-center h-100">
                <div class="loader-bounnce">
                    <span class="bounce"></span>
                    <span class="bounce"></span>
                    <span class="bounce"></span>
                </div>
            </div>
        </div>

        <header class="navbar bdg-navbar shadow">
            <div class="container">
                <div class="d-flex w-100 justify-content-between align-items-center">
                    <div class="logo">
                        <h2 class="brand-logo home m-0"><i class="fas fa-gauge-med"></i> expInc tracker</h2>
                    </div>

                    <div class="d-flex align-items-center dropdown">
                        <div class="user d-flex flex-column">
                            <h4 class="name"><?php echo $user->first_name ?></h4>
                            <h6 class="username"><?php echo $user->user_name ?></h6>
                        </div>
                        <a class="py-0 d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?php echo base_url() ?>/assets/img/avatar.png" alt="User-Profile" class="img-fluid avatar avatar-50 avatar-rounded">
                            <i class="fas fa-caret-down text-white"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><h6 class="dropdown-header" href="#">Hello, <?php echo $user->first_name ?></h6></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo base_url() ?>/auth/signout">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <section class="dashboard" style="margin-top: 5rem;">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="text-white mb-4">
                            <h2 class="m-0">Hello, <?php echo $user->first_name ?></h2>
                            <?php $dhour = date('H') ?>
                            <?php if($dhour >= 12 && $dhour <=15): ?>
                                <span class="text-muted opacity-75">Good Afternoon 🔅</span>
                            <?php elseif($dhour >= 16 && $dhour <= 23): ?>
                                <span class="text-muted opacity-75">Good Evening 🌆</span>
                            <?php elseif($dhour >= 00 && $dhour <=11): ?>
                                <span class="text-muted opacity-75">Good Morning ⛅</span>
                            <?php endif; ?>
                        </div>
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="card dash-card">
                                    <div class="card-body p-0">
                                        <div class="single-dashboard-element d-flex flex-column">
                                            <div class="icon">
                                                <i class="fas fa-money-bills"></i>
                                            </div>
                                            <span class="type">Total Balance</span>
                                            <h4 class="amount totalBalance"></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card dash-card">
                                    <div class="card-body p-0">
                                        <div class="single-dashboard-element d-flex flex-column">
                                            <div class="icon">
                                                <i class="fas fa-money-bill-trend-up"></i>
                                            </div>
                                            <span class="type">Income</span>
                                            <h4 class="amount totalIncome"></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card dash-card">
                                    <div class="card-body p-0">
                                        <div class="single-dashboard-element d-flex flex-column">
                                            <div class="icon">
                                                <i class="fas fa-money-bill-trend-up" style="transform: rotate(180deg);"></i>
                                            </div>
                                            <span class="type">Expenses</span>
                                            <h4 class="amount totalExpense"></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card dash-card">
                            <h6 class="card-title">Income Statistic</h6>
                            <div class="card-body">
                                <div id="incomeChart"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card dash-card">
                            <h6 class="card-title">Expense Statistic</h6>
                            <div class="card-body">
                                <div id="expenseChart"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-4 my-4">
                    <div class="col-md-6">
                        <div class="card dash-card">
                            <h6 class="card-title">Incomes</h6>
                            <div class="card-body px-0 incomeEntries"></div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card dash-card">
                            <h6 class="card-title">Expenses</h6>
                            <div class="card-body px-0 expenseEntries"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>  

        <button type="button" class="add-bdg d-flex align-items-center justify-content-center border-0" data-bs-toggle="modal" data-bs-target="#createmodal">
            <i class="fas fa-add"></i>
        </button>

        <div class="modal fade" id="createmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createmodal" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content shadow">
                    <div class="modal-header">
                        <h5 class="modal-title">Create</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open_multipart('', ['id' => 'entriesForm']) ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type" class="form-label">Type</label>
                                        <select name="type" id="type" class="form-select">
                                            <option value="">-Select type-</option>
                                            <option value="income">Income</option>
                                            <option value="expense">Expense</option>
                                        </select>
                                    </div>
                                </div>
 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category" class="form-label">Category</label>
                                        <select name="category" id="category" class="form-select">
                                            <option value="">-Select Category-</option> 
                                            <?php echo $categories; ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type" class="form-label">Amount</label>
                                        <input type="text" class="form-control" name="amount">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date_added" class="form-label">Date</label>
                                        <input type="date" class="form-control" name="date_added">
                                    </div>
                                </div>
                            </div>
                        <?php echo form_close() ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="savenew()">Create</button>
                    </div>
                </div>
            </div>
        </div>

        
        <script src="<?php echo base_url('assets') ?>/js/bootstrap.js"></script>
        <script src="<?php echo base_url('assets') ?>/js/jquery.min.js"></script>
        <script src="<?php echo base_url('assets') ?>/js/validate.min.js"></script>
        <script src="<?php echo base_url('assets') ?>/js/perfect-scrollbar.jquery.js"></script>
        <script src="<?php echo base_url('assets') ?>/js/formValidations.js"></script>
        <script src="<?php echo base_url('assets') ?>/js/iziToast.min.js"></script>
        <script src="<?php echo base_url('assets') ?>/js/toasts.js"></script>
        <script src="<?php echo base_url('assets') ?>/js/apexcharts.js"></script>
        <script src="<?php echo base_url('assets') ?>/js/chartconfig.js"></script>
        <script src="<?php echo base_url('assets') ?>/js/func.js"></script>

        <script>
            $(document).ready( () => {
                $('.incomeEntries, .expenseEntries').perfectScrollbar()
                fetchAmounts('<?php echo base_url() ?>/dashboard/fetchAmounts/<?php echo $id ?>')
                incomeEntry('<?php echo base_url() ?>/dashboard/fetchIncome/<?php echo $id ?>')
                expenseEntry('<?php echo base_url() ?>/dashboard/fetchExpense/<?php echo $id ?>')
                incomeChart('<?php echo base_url() ?>/dashboard/fetchincomedata/<?php echo $id ?>');
                expenseChart('<?php echo base_url() ?>/dashboard/fetchexpensedata/<?php echo $id ?>');
            })

            $(document).on("click", ".deleteEntry > i", function () {
                if(!confirm('Are you sure you want to delete this entry?')){
                    return
                }
                var idd = $(this).attr('data-id')
                var type = ''
                var parent = $(this).parents(':eq(2)')

                $(this).hasClass('income') ? type = 'income' : type = 'expense'

                $('#preloader').fadeIn()
                $.ajax({
                    method: 'POST',
                    url: '<?php echo base_url() ?>/dashboard/deleteentry/'+idd,
                })
                .done( (response) =>{
                    if(response == 'success'){
                        if(type == 'income'){
                            fetchAmounts('<?php echo base_url() ?>/dashboard/fetchAmounts/<?php echo $id ?>')
                            incomeChart('<?php echo base_url() ?>/dashboard/fetchincomedata/<?php echo $id ?>');
                            incomeEntry('<?php echo base_url() ?>/dashboard/fetchIncome/<?php echo $id ?>')
                        }
                        else{
                            fetchAmounts('<?php echo base_url() ?>/dashboard/fetchAmounts/<?php echo $id ?>')
                            expenseChart('<?php echo base_url() ?>/dashboard/fetchexpensedata/<?php echo $id ?>');
                            expenseEntry('<?php echo base_url() ?>/dashboard/fetchExpense/<?php echo $id ?>')
                        }
                        successToast('Success', 'Successfully deleted')
                    }
                    else{
                        warningToast('Error', response)
                    }
                })
                .fail( (response) => {
                    errorToast('Error', 'An error occured while deleting entry...Try again')
                })
                .always( () => {
                    $('#preloader').fadeOut()
                })
            })

            function savenew(){
                if(!$('#entriesForm').valid()){
                    return
                }

                var frmData = {}
                var data = $('#entriesForm').serializeArray()
                $.each(data, (key, input) => {
                    frmData[input.name] = input.value
                })

                $('#preloader').fadeIn()
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url('dashboard/saveentry') ?>',
                    data: frmData
                })
                .done( (response) => {
                    if(response == 'success'){
                        successToast('Success', 'Successfully added')
                        $('#createmodal').modal('hide');
                        $('#entriesForm')[0].reset()
                        if(frmData.type === 'income'){  
                            fetchAmounts('<?php echo base_url() ?>/dashboard/fetchAmounts/<?php echo $id ?>')        
                            incomeChart('<?php echo base_url() ?>/dashboard/fetchincomedata/<?php echo $id ?>');
                            incomeEntry('<?php echo base_url() ?>/dashboard/fetchIncome/<?php echo $id ?>')
                        }
                        else{
                            fetchAmounts('<?php echo base_url() ?>/dashboard/fetchAmounts/<?php echo $id ?>')
                            expenseChart('<?php echo base_url() ?>/dashboard/fetchexpensedata/<?php echo $id ?>');
                            expenseEntry('<?php echo base_url() ?>/dashboard/fetchExpense/<?php echo $id ?>')
                        }
                    }
                    else{
                        warningToast('Error', response)
                    }
                })
                .fail( (response) => {
                    errorToast('Error', 'An error occured...Try again')
                })
                .always( () => {
                    $('#preloader').fadeOut()
                })
            }
        </script>
    </body>
</html>