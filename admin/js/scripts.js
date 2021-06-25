const editor = new FroalaEditor("#froala", {
	heightMin: 200,
	// documentReady: true,
	toolbarInline: false,
});

const loader_bg = document.createElement("div");
const loader_spinner = document.createElement("div");
loader_bg.id = "load-screen";
loader_spinner.id = "loading";
loader_bg.appendChild(loader_spinner);

document.body.prepend(loader_bg);

const usersOnlineEl = document.getElementById("users-online");

function usersOnline() {
	return fetch("includes/functions.php?usersonline=result")
		.then((result) => {
			return result.json();
		})
		.then((data) => {
			usersOnlineEl.textContent = data;
		})
		.catch((error) => {
			console.log(error);
		});
}

window.addEventListener("DOMContentLoaded", () => {
	setTimeout(() => {
		loader_bg.remove();
	}, 800);
	setInterval(usersOnline, 1000);
});
