import "./bootstrap";

import Swal from "./plugins/sweetalert2";
import { customClass } from "./plugins/sweetalert2";
import moment from "moment";
import options from "./validator-options";

window.moment = moment;
window.Swal = Swal;
window.customClass = customClass;
window.appName = "infotechservices";
window.baseUrl = `${window.location.origin}/`;
window.requestsPath = `${baseUrl}/api/index.php`;
window.validatorOptions = options;
window.truncateString = (string, maxLength = 40) => {
  if (!string) return null;
  if (string.length <= maxLength) return string;
  return `${string.substring(0, maxLength)}...`;
};
window.showLoading = () => {
  let timerInterval;
  Swal.fire({
    title: "Please wait!",
    timerProgressBar: true,
    onBeforeOpen: () => {
      Swal.showLoading();
      timerInterval = setInterval(() => {
        const content = Swal.getContent();
        if (content) {
          const b = content.querySelector("b");
          if (b) {
            b.textContent = Swal.getTimerLeft();
          }
        }
      }, 100);
    },
    onClose: () => {
      clearInterval(timerInterval);
    }
  });
};

$(() => {
  $(document).tooltip();
  require("./components/add-repair");
  require("./components/add-request");
  require("./components/departments");
  require("./components/hwcomponents");
  require("./components/repairs");
  require("./components/requests");
  require("./components/sent_requests");
  require("./components/user-accounts");
  require("./components/assessment");
  require("./components/pre-post-insp");
  require("./components/employee");
  require("./components/logout");
  require("./components/login");
});
