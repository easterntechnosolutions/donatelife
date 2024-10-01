$(document).ready(function () {
  let e = document.getElementById("name"),
    t = document.getElementById("massage"),
    m = document.getElementById("mobile"),
    n = document.querySelector(".text"),
    i = document.querySelector(".massage");
    "" != t.value && t.setAttribute("value", ""),
    "" != e.value && e.setAttribute("value", ""),
    document.getElementById("name").addEventListener("keyup", function t() {
      n.textContent = e.value;
    }),
    e.addEventListener("focusout", function () {
      $("#use").click();
    }),
    (t.value = t.value.trim()),
    t.addEventListener("focusout", function () {
      $("#use").click();
    }),
    document.getElementById("massage").addEventListener("keyup", function e() {
      i.textContent = t.value;
    }),
    $("#cyp").on("click", function () {
      $(".croppie-container").remove(),
        $(".act").html(
          '<img  id="imagenFondo" style="height: 300px; width: 300px"   class="img-responsive d-none"  id="set"      />'
        ),
        $("#my-image").removeAttr("disabled").click();
    }),
    $("#my-image").change(function () {
      if (
        ($("#my-image").attr("disabled", "true"),
        $("#cyp").removeClass("d-none"),
        FileReader)
      ) {
        var a = new FileReader();
        a.readAsDataURL(this.files[0]),
          (a.onload = function (a) {
            $("#imagenFondo").attr("src", a.target.result);
            var l = new Croppie($("#imagenFondo")[0], {
              viewport: { width: 380, height: 380, type: "circle" },
              boundary: { width: 380, height: 380 },
              enableOrientation: !0,
            });
            $("#use").fadeIn(),
              $("#corp").removeClass("d-none"),
              $("#use").on("click", function () {
                (n.innerHTML = e.value),
                  (i.innerHTML = t.value),
                  l.result("base64").then(function (n) {
                    var i = [{ image: n }, { name: "myimgage.jpg" }];
                    $("#result").attr("src", i[0].image),
                      mergeImages([
                        { src: "../upload/image/bg0wo-circle.png", x: 0, y: 0 },
                        { src: i[0].image, x: 70, y: 45 },
                      ]).then((n) => {
                        $("#bg_img").attr("src", n),
                          $("#bg_img").on("load", function () {
                            var n = e.value,
                              i = t.value,
                              a = document.getElementById("imageCanvas"),
                              l = a.getContext("2d"),
                              o = $("#bg_img");
                            (a.width = o[0].naturalWidth),
                              (a.height = o[0].naturalHeight),
                              l.drawImage(o[0], 0, 0),
                              a.classList.add("show"),
                              (l.textAlign = "center"),
                              (l.fillStyle = "black"),
                              (l.textBaseline = "middle"),
                              (l.font =
                                "700  60px 'Myriad Set Pro', Arial, Helvetica, sans-serif"),
                            //   l.fillText(n, 280, 530),
                              l.fillText(n, 270, 490),
                              (l.textAlign = "center"),
                              (l.fillStyle = "black"),
                              (l.textBaseline = "middle"),
                              (l.font =
                                "600  32px 'camber', Arial, Helvetica, sans-serif"),
                              (function e(t, n, i, a, l, o) {
                                if ((o = o || 0) <= 0) {
                                  t.fillText(n, i, a);
                                  return;
                                }
                                for (
                                  var s = n.split(" "), r = 0, d = 1;
                                  s.length > 0 && d <= s.length;

                                ) {
                                  var c = s.slice(0, d).join(" ");
                                  t.measureText(c).width > o
                                    ? (1 == d && (d = 2),
                                      t.fillText(
                                        s.slice(0, d - 1).join(" "),
                                        i,
                                        a + l * r
                                      ),
                                      r++,
                                      (s = s.splice(d - 1)),
                                      (d = 1))
                                    : d++;
                                }
                                d > 0 && t.fillText(s.join(" "), i, a + l * r);
                              })(l, i, 270, 545, 30, 500);
                            var s = a.toDataURL("image/jpeg", 1);
                            (document.getElementById("image").style.display =
                              "none"),
                              document
                                .getElementById("output")
                                .setAttribute("href", s),
                              document
                                .getElementById("download")
                                .classList.remove("d-none");
                          });
                      });
                  });
              });
          });
      }
    })
    $('#mobile').keyup(function () {
       this.value = this.value.replace(/[^0-9\.]/g,'');
    });
    
});















