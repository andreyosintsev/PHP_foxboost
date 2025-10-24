(function () {
    document.addEventListener("DOMContentLoaded", () => {
        const campaigns = document.querySelectorAll(".campaign");

        campaigns.forEach((campaign) => {
            const campaignTitle = campaign.querySelector(".campaign__title");
            if (!campaignTitle) return console.error('DOM: no ".campaign__title" element found');

            campaignTitle.addEventListener("click", () => campaign.classList.toggle("campaign_expanded"));
        });
    });
})();
