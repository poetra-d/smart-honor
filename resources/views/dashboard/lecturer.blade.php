<div class="row">


    <div class="col-md-4 mb-4">


        <div class="card shadow-sm border-0">


            <div class="card-body">


                <small class="text-muted">
                    Total Meeting
                </small>


                <h2>

                    {{ $totalMeeting }}

                </h2>


            </div>


        </div>


    </div>





    <div class="col-md-4 mb-4">


        <div class="card shadow-sm border-0">


            <div class="card-body">


                <small class="text-muted">
                    Meeting Selesai
                </small>


                <h2 class="text-success">

                    {{ $completedMeeting }}

                </h2>


            </div>


        </div>


    </div>





    <div class="col-md-4 mb-4">


        <div class="card shadow-sm border-0">


            <div class="card-body">


                <small class="text-muted">
                    Total Honor
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
