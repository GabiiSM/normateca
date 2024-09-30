function changeVisibility(tab, lastTab, btn, lastBtn) {
	lastTab.style.display = "none";
	tab.style.display = "grid";

	btn.classList.toggle("active");
	lastBtn.classList.toggle("active");
}

document.addEventListener("DOMContentLoaded", () => {
	const elements = {
		tabs: {
			subir: document.getElementById("subir"),
			editar: document.getElementById("editar"),
			crear: document.getElementById("crear"),
			keyword: document.getElementById("keyword"),
			admins: document.getElementById("admins"),
		},
		buttons: {
			subir: document.getElementById("subirBtn"),
			editar: document.getElementById("editarBtn"),
			crear: document.getElementById("crearBtn"),
			keyword: document.getElementById("KeywordsBtn"),
			admins: document.getElementById("adminsBtn"),
			categoria: document.getElementById("categoriaBtn"),
			subcategoria: document.getElementById("subcatBtn"),
		},
		lastTab: document.getElementById("subir"),
		lastBtn: document.getElementById("subirBtn"),
		catStatus: false,
		subcatStatus: false,
	};

	elements.buttons.subir.addEventListener("click", () => {
		changeVisibility(
			elements.tabs.subir,
			elements.lastTab,
			elements.buttons.subir,
			elements.lastBtn
		);

		elements.lastTab = elements.tabs.subir;
		elements.lastBtn = elements.buttons.subir;
		localStorage.setItem("lastTab", "subir");
	});

	elements.buttons.editar.addEventListener("click", () => {
		changeVisibility(
			elements.tabs.editar,
			elements.lastTab,
			elements.buttons.editar,
			elements.lastBtn
		);

		elements.lastTab = elements.tabs.editar;
		elements.lastBtn = elements.buttons.editar;
		localStorage.setItem("lastTab", "editar");
	});

	elements.buttons.crear.addEventListener("click", () => {
		changeVisibility(
			elements.tabs.crear,
			elements.lastTab,
			elements.buttons.crear,
			elements.lastBtn
		);

		elements.lastTab = elements.tabs.crear;
		elements.lastBtn = elements.buttons.crear;
		localStorage.setItem("lastTab", "crear");
	});

	elements.buttons.keyword.addEventListener("click", () => {
		changeVisibility(
			elements.tabs.keyword,
			elements.lastTab,
			elements.buttons.keyword,
			elements.lastBtn
		);

		elements.lastTab = elements.tabs.keyword;
		elements.lastBtn = elements.buttons.keyword;
		localStorage.setItem("lastTab", "keyword");
	});

	elements.buttons.admins.addEventListener("click", () => {
		changeVisibility(
			elements.tabs.admins,
			elements.lastTab,
			elements.buttons.admins,
			elements.lastBtn
		);

		elements.lastTab = elements.tabs.admins;
		elements.lastBtn = elements.buttons.admins;
		localStorage.setItem("lastTab", "admins");
	});
});
