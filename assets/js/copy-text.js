class CopyText {
  constructor() {
    this.selector = "[data-btn-copy]";
  }

  static create(selector) {
    const copyText = new CopyText(selector);
    copyText.registerEvents();

    return copyText;
  }

  registerEvents() {
    $(document).on("click", this.selector, (e) => {
      const $elCurrent = $(e.currentTarget);
      const $code = $elCurrent.parent().find("[data-referral-value]");

      navigator.clipboard
        .writeText($code.text())
        .then(function () {
          // $elCurrent.text("Code copied");
          $elCurrent.html($elCurrent.data("code-copied"));
          // console.log('Text copied to clipboard');
        })
        .catch(function (error) {
          console.error("Error:", error);
        });
    });
  }
}

$(() => CopyText.create());
