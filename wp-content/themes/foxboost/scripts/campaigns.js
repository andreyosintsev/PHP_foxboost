(function () {
    // document.addEventListener("DOMContentLoaded", () => {
    //     const campaigns = document.querySelectorAll(".campaign");

    //     campaigns.forEach((campaign) => {
    //         const campaignTitle = campaign.querySelector(".campaign__title");

    //         campaignTitle.addEventListener("click", () => adjustCampaignHeight(campaign));
    //     });

    //     function adjustCampaignHeight(campaign) {
    //         const content = campaign.querySelector(".campaign__content");
    //         if (!content) return console.error('DOM: no ".campaign__content" element found');

    //         if (campaign.classList.contains("campaign_expanded")) {
    //             content.style.maxHeight = "0";
    //             campaign.classList.remove("campaign_expanded");
    //         } else {
    //             campaign.classList.add("campaign_expanded");
    //             content.style.maxHeight = content.scrollHeight + "px";
    //         }
    //     }
    // });

    document.addEventListener("DOMContentLoaded", () => {
        const campaigns = document.querySelectorAll(".campaign");

        campaigns.forEach((campaign) => {
            const campaignTitle = campaign.querySelector(".campaign__title");
            if (!campaignTitle) return console.error('DOM: no ".campaign__title" element found');

            campaignTitle.addEventListener("click", () => campaign.classList.toggle("campaign_expanded"));
        });
    });
})();
