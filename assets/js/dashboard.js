jQuery(function ($) {
  var loading = `
  <div class="overlay loading">
    <i class="fa fa-refresh fa-spin"></i>
  </div>`;

  var loanNeedsLoading = true;
  $("#loan-needs").append(loading);
  var toolNeedsLoading = true;
  $("#tool-needs").append(loading);
  var trainingNeedsLoading = true;
  $("#training-needs").append(loading);

  $.ajax({
    url: baseURL + "dashboard/getLoanNeeds",
    dataType: "json",
    type: "POST",
  })
    .done(function (data) {
      loanNeedsLoading = false;
      $("#loan-needs > .loading").remove();
      var loanNeedsList = showNeeds(data, "kredit");
      $("#loan-needs > .box-body").append(loanNeedsList);
    })
    .fail(function (error) {
      loanNeedsLoading = false;
      $("#loan-needs > .loading").remove();
      $("#loan-needs > .box-body").append(
        `<p style="text-align: center">${error}</p>`
      );
      console.log(error);
    });

  $.ajax({
    url: baseURL + "dashboard/getToolNeeds",
    dataType: "json",
    type: "POST",
  })
    .done(function (data) {
      toolNeedsLoading = false;
      $("#tool-needs > .loading").remove();
      var toolNeedsList = showNeeds(data, "sarana");
      $("#tool-needs > .box-body").append(toolNeedsList);
    })
    .fail(function (error) {
      toolNeedsLoading = false;
      $("#tool-needs > .loading").remove();
      $("#tool-needs > .box-body").append(
        `<p style="text-align: center">${error}</p>`
      );
      console.log(error);
    });

  $.ajax({
    url: baseURL + "dashboard/getTrainingNeeds",
    dataType: "json",
    type: "POST",
  })
    .done(function (data) {
      trainingNeedsLoading = false;
      $("#training-needs > .loading").remove();
      var trainingNeedsList = showNeeds(data, "pendidikan");
      $("#training-needs > .box-body").append(trainingNeedsList);
      console.log(data);
    })
    .fail(function (error) {
      trainingNeedsLoading = false;
      $("#training-needs > .loading").remove();
      $("#training-needs > .box-body").append(
        `<p style="text-align: center">${error}</p>`
      );
      console.log(error);
    });

  var showNeeds = function (data, key) {
    const html = `
      <div class="cluster-needs-list">
        ${data
          .map(function (item) {
            return `
            <div class="row">
              <div class="col-md-8">
              ${item[key]}
              </div>
              <div class="col-md-4"><b>${item.total}</b></div>
            </div>  
            `;
          })
          .join("")}
      </div>
    `;
    return html;
  };
});
