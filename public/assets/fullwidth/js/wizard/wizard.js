var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the current tab
        
        function showTab(n) {
         
          var x = document.getElementsByClassName("step");
          x[n].style.display = "block";
          console.log(n);
          console.log(x.length);
          console.log(n == (x.length - 1));
          if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
          } else {
            document.getElementById("prevBtn").style.display = "inline";
          }
          if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Submit";
          } else {
            document.getElementById("nextBtn").innerHTML = "Next";
          }


          //... and run a function that will display the correct step indicator:
          // fixStepIndicator(n)
        }
        
        function nextPrev(n) {

          var x = document.getElementsByClassName("step");

          if (n == 1 && !validateForm()) return false;
          console.log(currentTab);
          if(currentTab + n < 3)
          x[currentTab].style.display = "none";

          currentTab = currentTab + n;

          let z = document.getElementsByClassName("stepIndicator")

          if(currentTab > 0){
            if(n == 1){
              z[currentTab - 1].classList.add("active");
            }else if(n == -1){
              z[currentTab].classList.remove("active");
            }
          }else if(currentTab == 0){
            z[0].classList.remove("active");
          }

          if (currentTab >= x.length) {

            document.getElementById("signUpForm").submit();
            return false;

          }
          console.log(currentTab <= x.length);
          if(currentTab < x.length)
          showTab(currentTab);

        }
        
        function validateForm() {

          var x, y, i, valid = true;
          x = document.getElementsByClassName("step");

          y = x[currentTab].getElementsByClassName("required");

          for (i = 0; i < y.length; i++) {

            if (y[i].value == "") {

              y[i].className += " invalid is-invalid";

              valid = false;
            }
          }

          // if (valid) {
          //   document.getElementsByClassName("stepIndicator")[currentTab].className += " finish";
          // }
   
          return valid; // return the valid status
        }
        
        // function fixStepIndicator(n) {

        //   // This function removes the "active" class of all steps...
        //   var i, x = document.getElementsByClassName("stepIndicator");
          
        //   for (i = 0; i < x.length; i++) {
        //     x[i].className = x[i].className.replace(" active", "");
        //   }
        //   // if(x[])
        //   // ... and adds the "active" class on the current step:
        //   console.log(n);
        //   // x[n].className += " active";
        // }
