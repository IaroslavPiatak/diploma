document.querySelector(".modal").classList.add("open");

document.querySelector(".cross-btn").addEventListener("click", () =>
{
    document.querySelector(".modal").classList.remove("open");

});

window.addEventListener('keydown', (e) =>
{
    if(e.key === "Escape")
    {
        document.querySelector(".modal").classList.remove("open");
    }
});

