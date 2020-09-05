
<body>
<div class="container mt-3">
    <div class="card-header">Гостевая книга </div>
    <?php if($this->error):?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach($this->error as $item):?>
            <li><?=$item?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif;?>
    <form class="mt-3" method="post">
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Имя</label>
            <div class="col-sm-10">
                <input name="user_name" class="form-control"  placeholder="Имя" value="<?=$_POST['user_name']?>">

            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input name="user_email" class="form-control"  placeholder="Email" value="<?=$_POST['user_email']?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Homepage</label>
            <div class="col-sm-10">
                <input name="user_page" class="form-control"  placeholder="Homepage" value="<?=$_POST['user_page']?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Текст</label>
            <div class="col-sm-10">
                <textarea name="user_text" class="form-control" aria-label="With textarea" ><?=$_POST['user_text']?></textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Введите проверочный код</label>
            <div class="col-sm-10">
               <img src = "<?=PATH?>/helpers/captcha/captcha.php" />
                <input type = "text" name = "kaptcha" />
            </div>
        </div>


        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Отправить</button>
            </div>
        </div>
    </form>

            <div class="card">
                <div class="card-header">Сообщения</div>
                <div class="card-body">
                    <a href="/">Сбросить сортировку</a>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th><a href="/?sort=user_name"> Имя</a></th>
                            <th><a href="/?sort=e-mail">Email</a></th>
                            <th><a href="/?sort=time">Дата</a></th>
                            <th>Текст</th>

                        </tr>
                        </thead>
                        <tbody>
<?php

foreach($this->items as $item):?>
                        <tr>
                            <td><?=$item['user_name']?></td>
                            <td><?=$item['e-mail']?></td>
                            <td><?=$item['time']?></td>
                            <td><?=$item['message']?></td>
                        </tr>
<?php endforeach; ?>
                        </tbody>
                    </table>



                </div>

            </div>
    <?php if($this->pagin):?>
    <nav aria-label="Page navigation example" class="mt-3">
        <ul class="pagination justify-content-center">
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <li class="page-item"><a class="page-link" href="/?page=11">1</a></li>
            <?php for($i=1; $i<=$this->pagin-1; $i++):?>
            <li class="page-item"><a class="page-link" href="/?page=<?=$i;?>"><?=$i+1;?></a></li>
            <?php endfor;?>
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </nav>
<?php endif;?>


</div>
</body>
</html>









