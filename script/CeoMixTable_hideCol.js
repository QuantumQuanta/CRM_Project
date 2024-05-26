var mixtable_dropDown = document.getElementById("mixTableHide_myDropdown");
$("#mixTableHide_dropbtn").on("click", function (e) {
    e.preventDefault();
    if (mixtable_dropDown.style.display === "none") {
        mixtable_dropDown.style.display = "block";
    } else if (mixtable_dropDown.style.display === "block") {
        mixtable_dropDown.style.display = "none";
    }
});
const date_time_mx = document.querySelector("#date_time_hidemx");
const contact_us_mx = document.querySelector("#contact_us_hidemx");
const kyc_mx = document.querySelector("#kyc_hidemx");
const pcr_pr_mx = document.querySelector("#pcr_pr_hidemx");
const pcr_et_mx = document.querySelector("#pcr_et_hidemx");
const call_ty_mx = document.querySelector("#call_ty_hidemx");
const call_st_mx = document.querySelector("#call_st_hidemx");
const category_mx = document.querySelector("#category_hidemx");
const source_mx = document.querySelector("#source_hidemx");
const com1_mx = document.querySelector("#com1_hidemx");
const client_st1_mx = document.querySelector("#client_st1_hidemx");
const pcs_res1_mx = document.querySelector("#pcs_res1_hidemx");
const pcr_pt1_mx = document.querySelector("#pcr_pt1_hidemx");
const client_rt1_mx = document.querySelector("#client_rt1_hidemx");
const com2_mx = document.querySelector("#com2_hidemx");
const client_st2_mx = document.querySelector("#client_st2_hidemx");
const pcs_res2_mx = document.querySelector("#pcs_res2_hidemx");
const pcr_pt2_mx = document.querySelector("#pcr_pt2_hidemx");
const pcr_prc_mx = document.querySelector("#pcr_prc_hidemx");
const client_rt2_mx = document.querySelector("#client_rt2_hidemx");

var Mixtable = document.querySelector("#mixedDataTableCont");
console.log("Mixtable", Mixtable);

function toggleColumn2(targetColIndex) {
    console.log("targetColIndex", targetColIndex);
    const MixTablecells = Mixtable.querySelectorAll(
        `td:nth-of-type(${targetColIndex}), th:nth-of-type(${targetColIndex})`
    );

    // console.log("MixTablecells", MixTablecells);

    // Check if any cell has the "hidden" class, then remove it; otherwise, add it
    if (MixTablecells[0].classList.contains("hidden")) {
        // console.log("in if ")
        MixTablecells.forEach((cell) => {
            // console.log("in if remove(hidden)");
            cell.classList.remove("hidden");
        });
    } else {
        // console.log("in else")
        MixTablecells.forEach((cell) => {
            // console.log("in else add(hidden)")
            cell.classList.add("hidden");
        });
    }

    // Store the state of the toggled column in local storage
    localStorage.setItem(
        `mixcol-${targetColIndex}`,
        MixTablecells[0].classList.contains("hidden")
    );
}

date_time_mx.addEventListener("click", () => {
    toggleColumn2(1);
});
contact_us_mx.addEventListener("click", () => {
    toggleColumn2(2);
});
kyc_mx.addEventListener("click", () => {
    toggleColumn2(3);
});
pcr_pr_mx.addEventListener("click", () => {
    toggleColumn2(4);
});
pcr_et_mx.addEventListener("click", () => {
    toggleColumn2(5);
});
call_ty_mx.addEventListener("click", () => {
    toggleColumn2(6);
});
call_st_mx.addEventListener("click", () => {
    toggleColumn2(7);
});
category_mx.addEventListener("click", () => {
    toggleColumn2(8);
});
source_mx.addEventListener("click", () => {
    toggleColumn2(9);
});
com1_mx.addEventListener("click", () => {
    toggleColumn2(10);
});
client_st1_mx.addEventListener("click", () => {
    toggleColumn2(11);
});
pcs_res1_mx.addEventListener("click", () => {
    toggleColumn2(12);
});
pcr_pt1_mx.addEventListener("click", () => {
    toggleColumn2(13);
});
client_rt1_mx.addEventListener("click", () => {
    toggleColumn2(14);
});
com2_mx.addEventListener("click", () => {
    toggleColumn2(15);
});
client_st2_mx.addEventListener("click", () => {
    toggleColumn2(16);
});
pcs_res2_mx.addEventListener("click", () => {
    toggleColumn2(17);
});
pcr_pt2_mx.addEventListener("click", () => {
    toggleColumn2(18);
});
pcr_prc_mx.addEventListener("click", () => {
    toggleColumn2(19);
});
client_rt2_mx.addEventListener("click", () => {
    toggleColumn2(20);
});

// Retrieve the stored state of the toggled columns and apply them on page load
for (let i = 1; i <= 16; i++) {
    const isHidden = localStorage.getItem(`mixcol-${i}`) === "true";
    if (isHidden) {
        toggleColumn2(i);
    }
}

const mixTableButtons = document.querySelectorAll("#mixTableHide_myDropdown button");

mixTableButtons.forEach((button) => {
    let isBlue = localStorage.getItem(button.id) === "true";

    if (isBlue) {
        button.classList.add("blue-button");
    }

    button.addEventListener("click", () => {
        if (isBlue) {
            button.classList.remove("blue-button");
            localStorage.setItem(button.id, false);
        } else {
            button.classList.add("blue-button");
            localStorage.setItem(button.id, true);
        }
        isBlue = !isBlue;
    });
});

