<?php include'header.php' ?>
<style>
    ul, #myUL {
        list-style-type: none;
    }

    #myUL {
        margin: 0;
        padding: 0;
    }

    .caret {
        cursor: pointer;
        -webkit-user-select: none; /* Safari 3.1+ */
        -moz-user-select: none; /* Firefox 2+ */
        -ms-user-select: none; /* IE 10+ */
        user-select: none;
    }

    .caret::before {
        content: "\25B6";
        color: black;
        display: inline-block;
        margin-right: 6px;
    }

    .caret-down::before {
        -ms-transform: rotate(90deg); /* IE 9 */
        -webkit-transform: rotate(90deg); /* Safari */
        transform: rotate(90deg);
    }

    .nested {
        display: none;
    }

    .active {
        display: block;
    }
    span.dropbtn input {
    border-radius: 50% !important;
}
</style>
<div class="content-wrapper" style="background:white">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"> Genelogy View</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"> Genelogy View</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <ul id="myUL">
                    <li>
                        <span class="caret"><?php echo $this->session->userdata['user_id']; ?></span>
                        <ul class="nested">
                            <?php foreach ($directs as $direct) {
                                ?>
                                <li>
                                    <span class="caret innerCaret" data-user_id="<?php echo $direct['user_id']; ?>"><?php echo $direct['user_id']; ?></span>
                                    <ul class="nested">
                                        <li>fs</li>
                                    </ul>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
      </div>
    </div>
  </div>
<?php include'footer.php' ?>

<script>
    var toggler = document.getElementsByClassName("caret");

    $(document).on('click', '.caret', function () {
//        $(this).parent('li').find('ul').toggle('active')
        var i;

        for (i = 0; i < toggler.length; i++) {
            toggler[i].addEventListener("click", function () {
                this.parentElement.querySelector(".nested").classList.toggle("active");
                this.classList.toggle("caret-down");
            });
        }
    })
    $(document).on('click', '.innerCaret', function () {
        var t = $(this);
//        console.log($(this).parent('li').find('ul').html('<li><span class="caret">Lemon Tea</span></li>'))
        var url = '<?php echo base_url('Dashboard/User/genelogy_users/'); ?>';
        var html = '';
        $.get(url + $(this).data('user_id'), function (res) {
            $.each(res.directs, function (key, value) {
                html += '<li><span class="caret innerCaret" data-user_id="' + value.user_id + '">' + value.user_id + '</span><ul class="nested"></ul></li>';
            })
            t.parent('li').find('ul').html(html);
        }, 'json');
    });
</script>
