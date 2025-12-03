(function () {
    document.addEventListener("DOMContentLoaded", () => {
        const campaigns = document.querySelectorAll(".campaign");

        campaigns.forEach((campaign) => {
            const campaignHeader = campaign.querySelector(".campaign__header");
            if (!campaignHeader) return console.error('DOM: no ".campaign__header" element found');

            campaignHeader.addEventListener("click", (e) => {
                if (e.target.closest('.campaign__control')) return;

                campaign.classList.toggle("campaign_expanded")
            });
        });
    });
})();
