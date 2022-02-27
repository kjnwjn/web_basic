function validator(options) {
  function getParent(element, selector) {
    while (element.parentElement) {
      console.log(element.parentElement);
      if (element.parentElement.matches(selector)) {
        return element.parentElement;
      }
      element = element.parentElement;
    }
  }
  selectorRules = {};

  function validate(inputElement, rule) {
    var inputMessage;
    var errorElement = getParent(
      inputElement,
      options.formGroupSelector
    ).querySelector(options.errorSelector);

    //Lấy ra các rules của selector
    var rules = selectorRules[rule.selector];

    //lặp qua từng role để kiểm tra
    //nếu mà có lỗi thì dừng việc kiểm tra
    for (i = 0; i < rules.length; ++i) {
      switch (inputElement.type) {
        case "radio":
        case "checkbox":
          inputMessage = rules[i](
            formElement.querySelector(rule.selector + ":checked")
          );
          // console.log(inputMessage)
          break;
        default:
          inputMessage = rules[i](inputElement.value);
      }
      if (inputMessage) break;
    }

    if (inputMessage) {
      errorElement.innerHTML = inputMessage;

      getParent(inputElement, options.formGroupSelector).classList.add(
        "invalid"
      );
    } else {
      errorElement.innerHTML = "";
      getParent(inputElement, options.formGroupSelector).classList.remove(
        "invalid"
      );
    }

    return !inputMessage;
  }

  //lấy element của form cần validate
  var formElement = document.querySelector(options.form);
  if (formElement) {
    formElement.onsubmit = function (e) {
      e.preventDefault();

      isFormValue = true;
      options.rules.forEach(function (rule) {
        var inputElement = formElement.querySelector(rule.selector);
        // console.log(inputElement)
        var isValid = validate(inputElement, rule);
        if (!isValid) {
          isFormValue = false;
        }
      });

      if (isFormValue) {
        if (typeof options.onSubmit === "function") {
          var enableInput = formElement.querySelectorAll(
            "[name]:not([disabled])"
          );

          var formValues = Array.from(enableInput).reduce(function (
            values,
            input
          ) {
            switch (input.type) {
              case "radio":
                values[input.name] = formElement.querySelector(
                  'input[name="' + input.name + '"]:checked'
                ).value;
                // console.log(values[input.name])
                break;
              case "checkbox":
                if (!input.matches(":checked")) {
                  values[input.name] = [];
                  return values;
                }
                if (!Array.isArray(values[input.name])) {
                  values[input.name] = [];
                }
                values[input.name].push(input.value);
                break;
              case "file":
                values[input.name] = input.files;
                break;
              default:
                values[input.name] = input.value;
            }
            return values;
          },
          {});
          options.onSubmit(formValues);
        }
      }
    };

    //lặp qua mỗi rule và xử lý(lắng nghe sự kiên blur, oninput ....)
    options.rules.forEach(function (rule) {
      //lưu lại mỗi rule cho input
      if (Array.isArray(selectorRules[rule.selector])) {
        selectorRules[rule.selector].push(rule.test);
      } else {
        selectorRules[rule.selector] = [rule.test];
      }

      var inputElements = formElement.querySelectorAll(rule.selector);
      Array.from(inputElements).forEach((inputElement) => {
        // xử lí trường hợp blur khỏi input
        inputElement.onblur = function () {
          // Lấy được value = inputElement
          // lấy test function = rule.test
          validate(inputElement, rule);
        };

        // xử lí mỗi khi người dùng nhập vào input
        inputElement.oninput = function () {
          var errorElement = getParent(
            inputElement,
            options.formGroupSelector
          ).querySelector(options.errorSelector);
          errorElement.innerHTML = "";
          getParent(inputElement, options.formGroupSelector).classList.remove(
            "invalid"
          );
        };
      });
      // console.log(selectorRules)
    });
  }
}

// Định nghĩa rules
validator.isRequired = function (selector, message) {
  return {
    selector: selector,
    test: function (value) {
      return value ? undefined : message || "Vui lòng nhập trường này";
    },
  };
};

validator.isEmail = function (selector, message) {
  return {
    selector: selector,
    test: function (value) {
      var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      return regex.test(value) ? undefined : message || "Email không hợp lệ";
    },
  };
};

validator.minLength = function (selector, min, message) {
  return {
    selector: selector,
    test: function (value) {
      return value.length >= min
        ? undefined
        : message || `Vui lòng nhập tối thiểu ${min} kí tự`;
    },
  };
};

validator.confirmed = function (selector, confirm, message) {
  return {
    selector: selector,
    test: function (value) {
      return value == confirm()
        ? undefined
        : message || "Giá trị nhập vào không chính xác";
    },
  };
};
