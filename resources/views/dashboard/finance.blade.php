<div class="row">


    <div class="col-md-3 mb-4">


        <div class="card shadow-sm border-0">


            <div class="card-body">


                <small class="text-muted">
                    Total Payment
                </small>


                <h2>

                    {{ $totalPayment }}

                </h2>


            </div>


        </div>


    </div>




    <div class="col-md-3 mb-4">


        <div class="card shadow-sm border-0">


            <div class="card-body">


                <small class="text-muted">
                    Draft
                </small>


                <h2 class="text-warning">

                    {{ $draftPayment }}

                </h2>


            </div>


        </div>


    </div>





    <div class="col-md-3 mb-4">


        <div class="card shadow-sm border-0">


            <div class="card-body">


                <small class="text-muted">
                    Paid
                </small>


                <h2 class="text-success">

                    {{ $paidPayment }}

                </h2>


            </div>


        </div>


    </div>





    <div class="col-md-3 mb-4">


        <div class="card shadow-sm border-0">


            <div class="card-body">


                <small class="text-muted">
                    Honor Terbayarkan Bulan Ini
                </small>


                <h5>

                    Rp {{ number_format(
    $totalHonor,
    0,
    ',',
    '.'
) }}

                </h5>


            </div>


        </div>


    </div>



</div>
