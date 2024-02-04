const getBrowserName = () => {
    let browserInfo = navigator.userAgent;
    console.log(browserInfo);
    let browser;

    if (browserInfo.includes("Opera") || browserInfo.includes("Opr")) {
        browser = "Opera";
    } else if (browserInfo.includes("Edg")) {
        browser = "Edge";
    } else if (browserInfo.includes("Chrome")) {
        browser = "Chrome";
    } else if (browserInfo.includes("Safari")) {
        browser = "Safari";
    } else if (browserInfo.includes("Firefox")) {
        browser = "Firefox";
    } else {
        browser = "unknown";
    }

    return browser;
};
jQuery(document).ready(function ($) {
    $("#wp-submit").click(function (e) {
        e.preventDefault();
         let browserName = getBrowserName();

         // Example: Display the browser name in an alert
        //  alert("Browser: " + browserName);
    });
});
