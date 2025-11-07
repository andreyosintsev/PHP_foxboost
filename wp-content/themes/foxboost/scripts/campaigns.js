(function () {
    document.addEventListener("DOMContentLoaded", () => {
        const campaigns = document.querySelectorAll(".campaign");

        campaigns.forEach((campaign) => {
            const campaignTitle = campaign.querySelector(".campaign__header");
            if (!campaignTitle) return console.error('DOM: no ".campaign__header" element found');

            campaignTitle.addEventListener("click", () => campaign.classList.toggle("campaign_expanded"));
        });
    });
})();
