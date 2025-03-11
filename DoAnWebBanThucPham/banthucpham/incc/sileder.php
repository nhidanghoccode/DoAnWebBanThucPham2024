<!-- <?php include_once '../class/sileder.php';?> -->
    <!-- PHẦN SILE SHOW-->
    <div class="container-fluid py-5 mb-5 hero-header " style="margin-top: 96px !important;">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-md-12 col-lg-5" style="height: 250px;">
                    <h1 class="mb-5 display-3 text-primary" style="text-align: center;">Dinh dưỡng tốt, cuộc sống khỏe mạnh</h1>
                </div>
                <div class="col-md-12 col-lg-7" style="height: 350px;">
                    <section id="silide">
                        <div class="aspect-ratio-169">
                            <?php
                                $hienthiSileder =$sl->hienthiSileder();
                                if( $hienthiSileder){
                                    while($resule =  $hienthiSileder->fetch_assoc()){
                            ?>
                            <img src="admin/upload/<?php echo $resule['sileImg'] ?>" alt="" style="height: 100%; width:100%;">
                            <?php
                                    }
                                }
                            ?>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <script>
         const imgPo=document.querySelectorAll(".aspect-ratio-169 img")
    const imgCo=document.querySelector(".aspect-ratio-169")
    let imgNum=imgPo.length
    let index = 0

    imgPo.forEach(function(img,index){
        img.style.left=index*100 + "%"
    });

    function imgSile(){
        index++
        if(index>=imgNum){
            index=0
        }
        imgCo.style.left = "-" +index*100+"%"
        sileder(index)
    }
    function sileder(index){
        imgCo.style.left = "-" +index*100+"%"

    }
    setInterval(imgSile,3000)//setInterval: lặp lại 1 khối code sau một khoản tg nhất định
    </script>
    <!-- PHẦN SILE SHOW -->