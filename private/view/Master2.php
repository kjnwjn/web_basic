<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="./public/assest/css/validate.css" />
</head>

<body>
    <div class="main">
        <form action="" method="POST" class="form" id="form-1">


            <?php require_once('./private/view/pages/' . $data['page'] . '.php'); ?>
            <!-- <div class="form-group">
                <label for="province" class="form-label">Tỉnh/TP</label>
                <select id="province" name="province" class="form-control">
                    <option value="">-- Chọn Tỉnh/TP --</option>
                    <option value="hn">-- Hà Nội --</option>
                    <option value="hp">-- Hải Phòng --</option>
                </select>
                <span class="form-message"></span>
            </div>
            <div class="form-group">
                <label for="gender" class="form-label">Giới tính</label>
                <div class="form_gender">
                    <div class="gender_input">
                        <input name="gender" type="radio" class="form-control" value="male" />nam
                    </div>
                    <div class="gender_input">
                        <input name="gender" type="radio" class="form-control" value="female" />nữ
                    </div>
                    <div class="gender_input">
                        <input name="gender" type="radio" class="form-control" value="other" />khác
                    </div>
                </div>
                <span class="form-message"></span>
            </div>
            <div class="form-group">
                <label for="checkbox" class="form-label">Khảo sát</label>
                <div class="form_gender">
                    <div class="gender_input">
                        <input name="checkbox" type="checkbox" class="form-control" value="abc" />abc
                    </div>
                    <div class="gender_input">
                        <input name="checkbox" type="checkbox" class="form-control" value="xyz" />xyz
                    </div>
                    <div class="gender_input">
                        <input name="checkbox" type="checkbox" class="form-control" value="ght" />ght
                    </div>
                </div>
                <span class="form-message"></span>
            </div> -->

            <button class="form-submit">Đăng ký</button>
        </form>
    </div>

    <script src="./public/js/validator.js"></script>
    <script>
        validator({
            form: "#form-1",
            errorSelector: ".form-message",
            formGroupSelector: ".form-group",
            rules: [
                validator.isRequired("#fullname"),
                validator.isRequired("#phoneNumber"),
                validator.isRequired("#email"),
                validator.isRequired("#address"),
                validator.isRequired("#date"),
                validator.isRequired("#idCard1"),
                validator.isRequired("#idCard2"),
                validator.isRequired("#date"),
                validator.isEmail("#email"),
                validator.isRequired("#password"),
                validator.minLength("#password", 3),
                validator.isRequired("#password_confirmation"),
                validator.confirmed(
                    "#password_confirmation",
                    () => document.querySelector("#form-1 #password").value,
                    "Mật khẩu nhập lại không chính xác"
                ),
                validator.isRequired("#province"),
                validator.isRequired("input[name='gender']"),
                validator.isRequired("input[name='checkbox']"),

            ],
            onSubmit: function(data) {
                console.log(data);
            },
        });
    </script>
</body>

</html>