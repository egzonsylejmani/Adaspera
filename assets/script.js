//Cart Page
function returnTotalAmount() {
  let cartPriceObj = document.querySelectorAll(".cart-item .cart-price");
  if (cartPriceObj.length > 0) {
    if (cartPriceObj.length > 1) {
      document.querySelector(".shopping-bag-items-count").innerText = cartPriceObj.length + " items";
    } else {
      document.querySelector(".shopping-bag-items-count").innerText = cartPriceObj.length + " item";
    }
  }
  let cartSum = 0;
  for (let i = 0; i < cartPriceObj.length; i++) {
    cartSum += parseFloat(cartPriceObj[i].innerText.split(" ")[0]);
  }
  if (document.querySelector(".cart-summary-row .subtotal-price") && document.querySelector(".cart-summary-row .delivery-amount") && document.querySelector(".cart-summary-row .total-price")) {
    document.querySelector(".cart-summary-row .subtotal-price").innerText = cartSum + " €";
    let totalAmount =
      parseFloat(document.querySelector(".cart-summary-row .subtotal-price").innerText.split(" ")[0]) +
      parseFloat(document.querySelector(".cart-summary-row .delivery-amount").innerText.split(" ")[0]);

    document.querySelector(".cart-summary-row .total-price").innerText = parseFloat(totalAmount.toFixed(2)) + " €";
  }
}
returnTotalAmount();

document.addEventListener("click", (event) => {
  if (event.target.closest(".cart-remove-item")) {
    event.target.closest(".cart-item").remove();
    returnTotalAmount();
    if (document.querySelectorAll(".cart-item .cart-price").length == 0) {
      document.querySelector(".empty-cart").style.display = "block";
      document.querySelector(".not-empty-cart").style.display = "none";
    }
  }
});

document.addEventListener("click", (event) => {
  if (event.target.closest(".size-btn") && document.querySelector(".add-to-bag")) {
    if (document.querySelector(".sizesActive")) {
      for (let i = 0; i < document.querySelectorAll(".sizesActive").length; i++) {
        document.querySelectorAll(".sizesActive")[i].classList.remove("sizesActive");
      }
    }
    if (!event.target.closest(".size-btn").classList.contains("sizeActive")) {
      event.target.closest(".size-btn").classList.add("sizesActive");
      document.querySelector(".add-to-cart-button").href = document.querySelector(".add-to-cart-button").href + "&size=" + event.target.innerText;
    }
  } else if (event.target.closest(".add-to-cart-button")) {
    if (!document.querySelector(".sizesActive")) {
      if (!document.querySelector(".select-size-error")) {
        html = `<p class ='select-size-error' style="padding: 0 0 13px 0px;font-weight: 500;color: red;font-size: 17px;">* Please select a size </p>`;
        var tmpEl = document.createElement("div");

        tmpEl.innerHTML = html;

        html = tmpEl.firstChild;

        document.querySelector(".add-to-bag").prepend(html);
      }
      event.preventDefault();
    } else {
      let productID = event.target.href.split("&product_id=")[1].split("&")[0];
      let size = document.querySelector(".sizesActive").innerText;
      for (var i = 0; i < productsArray.length; i++) {
        if (productsArray[i]["product_id"] == productID && productsArray[i]["size"] == size) {
          html = `<p class ='already-exists-cart-error' style="padding: 0 0 13px 0px;font-weight: 500;color: red;font-size: 17px;">* Already exists on the cart </p>`;
          var tmpEl = document.createElement("div");

          tmpEl.innerHTML = html;

          html = tmpEl.firstChild;
          if (!document.querySelector(".already-exists-cart-error")) {
            if (document.querySelector(".select-size-error")) {
              document.querySelector(".select-size-error").remove();
            }
            document.querySelector(".add-to-bag").prepend(html);
          }
          event.preventDefault();

          break;
        }
      }
    }
  }
});

const about = document.querySelector(".about");
const btns = document.querySelectorAll(".tab-btn");
const articles = document.querySelectorAll(".content");
if (about) {
  about.addEventListener("click", function (e) {
    const id = e.target.dataset.id;
    if (id) {
      // remove selected from other buttons
      btns.forEach(function (btn) {
        btn.classList.remove("active");
      });
      e.target.classList.add("active");
      // hide other articles
      articles.forEach(function (article) {
        article.classList.remove("active");
      });
      const element = document.getElementById(id);
      element.classList.add("active");
    }
  });
}
//Account page
if (document.querySelector(".account_page_form .nav-item")) {
  document.addEventListener("click", (event) => {
    if (event.target.closest(".nav-item.register") && !event.target.closest(".nav-item.register").classList.contains("active")) {
      document.querySelector(".login-form").style.display = "none";
      document.querySelector(".register-form").style.display = "block";
      event.preventDefault();
    } else if (event.target.closest(".nav-item.login") && !event.target.closest(".nav-item.login").classList.contains("active")) {
      document.querySelector(".register-form").style.display = "none";
      document.querySelector(".login-form").style.display = "block";
      event.preventDefault();
    } else if (event.target.closest(".form-buttons .btn-secondary")) {
      document.querySelector(".login-form").style.display = "none";
      document.querySelector(".register-form").style.display = "block";
      event.preventDefault();
    }
  });
}

if (window.location.href.includes("account.php") && window.location.href.includes("?register=error")) {
  document.querySelector(".login-form").style.display = "none";
  document.querySelector(".register-form").style.display = "block";
}
const submitbtn = document.querySelector(".btn-primary[value=Register]");

if (submitbtn) {
  submitbtn.addEventListener("click", (e) => {
    const name = document.querySelector("input[name=firstname]");
    const lname = document.querySelector("input[name=lastname]");
    const sex = document.querySelector("input[name=sex]");
    const mobile = document.querySelector("input[name=mobile]");
    const birthday = document.querySelector("input[name=birthday]");
    const email = document.querySelector("input[name=register-email]");
    const pw = document.querySelector("input[name=register-password]");
    const error = document.querySelector(".account_page_form");
    let message = "";
    message = validateRegForm(name, lname, email, pw, birthday, sex, mobile);

    if (message.length > 0) {
      e.preventDefault();
      document.querySelector(".error-msg p").innerText = message;
    }
  });
}

function validateRegForm(name, lname, email, pw, birthday, sex, mobile) {
  if (name.value === "" && lname.value === "" && email.value === "" && pw.value === "" && sex.value === "" && mobile.value === "" && birthday.value == "") {
    //Nese jane te gjitha empty atehere shfaq mesazhin se te gjitha fushat duhet te plotesohen
    return "All fields have to be ";
  }
  let counter = 0;
  if (name.value === "" || name.value == null) {
    document.getElementById("firstName").innerHTML = "* You must enter a name";
    counter++;
    // return false;
  } else {
    document.getElementById("firstName").innerHTML = "";
  }
  if (lname.value === "" || lname == null) {
    document.getElementById("lastName").innerHTML = "* You must enter a last name";
    counter++;

    // return false;
  } else {
    document.getElementById("lastName").innerHTML = "";
  }

  if (!onlyLetters(name)) {
    document.getElementById("firstName").innerHTML = "* The name must be more than 2 letters.";
    counter++;

    // return false;
  } else {
    document.getElementById("firstName").innerHTML = "";
  }

  if (!onlyLetters(lname)) {
    document.getElementById("lastName").innerHTML = "* The last name must be more than 2 letters.";
    counter++;

    // return false;
  } else {
    document.getElementById("lastName").innerHTML = "";
  }

  if (email.value === "" || email == null) {
    document.getElementById("email-address").innerHTML = "* You must enter an email";
    counter++;

    // return false;
  } else {
    document.getElementById("email-address").innerHTML = "";
  }
  if (!validateEmail(email)) {
    document.getElementById("email-address").innerHTML = "* Email is not valid";
    counter++;

    // return false;
  } else {
    document.getElementById("email-address").innerHTML = "";
  }
  if (pw.value === "" || pw == null) {
    document.getElementById("password").innerHTML = "* You need to enter password";
    counter++;

    // return false;
  } else {
    document.getElementById("password").innerHTML = "";
  }
  if (!validatePassword(pw)) {
    document.getElementById("password").innerHTML = "* Password must have min. 8 characters, min. 1 capital letter and min. 1 number";
    document.getElementById("password").style.top = "-10px";

    counter++;

    // return false;
  } else {
    document.getElementById("password").innerHTML = "";
  }
  if (birthday.value === "" || birthday == null) {
    document.getElementById("dateBirthday").innerHTML = "* You must complete Birthday";
    counter++;

    // return false;
  } else {
    document.getElementById("dateBirthday").innerHTML = "";
  }
  if (sex.value === "" || sex == null) {
    document.getElementById("gender").innerHTML = "* You must select gender.";
    counter++;

    // return false;
  } else {
    document.getElementById("gender").innerHTML = "";
  }
  if (mobile.value === "" || mobile == null) {
    document.getElementById("mobile-phone").innerHTML = "* You must write mobile phone";
    counter++;

    // return false;
  } else {
    document.getElementById("mobile-phone").innerHTML = "";
  }
  if (counter > 0) {
    return false;
  }
  return "";
}

// validate login form
const loginsubmit = document.querySelector(".btn-primary[name=login]");
if (loginsubmit) {
  loginsubmit.addEventListener("click", (e) => {
    const email = document.getElementById("login-email");
    const pw = document.getElementById("login-password");
    let message = "";
    message = validateLoginForm(email, pw);

    if (message.length > 0) {
      e.preventDefault();
      document.querySelector(".error-msg p").innerText = message;
    }
  });
}

function validateLoginForm(email, pw) {
  if (email.value === "" && pw.value === "") {
    document.getElementById("error-message").innerHTML = "* You must complete the fields ";
    return false;
  } else {
    document.getElementById("error-message").innerHTML = "";
  }
  if (email.value === "" || email == null) {
    document.getElementById("emailrequired").innerHTML = "You must write email.";
    return false;
  } else {
    document.getElementById("emailrequired").innerHTML = "";
  }
  if (!validateEmail(email)) {
    document.getElementById("emailrequired").innerHTML = "* You must write correct email.";
    return false;
  } else {
    document.getElementById("emailrequired").innerHTML = "";
  }
  if (pw.value === "" || pw == null) {
    document.getElementById("passwordrequired").innerHTML = "* You must write the password correct";
    document.getElementById("passwordrequired").style.top = "-7px";
    return false;
  } else {
    document.getElementById("passwordrequired").innerHTML = "";
  }
}

// validate if it has only letters
function onlyLetters(string) {
  const regex = /^[A-Za-z]{2,}$/;
  return string.value.match(regex);
}

function validateEmail(email) {
  const regex = /^[\w-\.]+@([\w-]+)+.[\w-]{2,4}$/; //validate email
  return email.value.match(regex);
}

function validatePassword(pw) {
  const regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/; //validate if it has minumum 8 characters, min 1 numer
  return pw.value.match(regex); //and 1 min uppercase
}
if (document.querySelector(".home-banners")) {
  var slideIndex = 1;
  showSlides(slideIndex);

  function plusSlides(n) {
    showSlides((slideIndex += n));
  }

  function currentSlide(n) {
    showSlides((slideIndex = n));
  }

  function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    if (n > slides.length) {
      slideIndex = 1;
    }
    if (n < 1) {
      slideIndex = slides.length;
    }
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active-dot", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active-dot";
  }
}
