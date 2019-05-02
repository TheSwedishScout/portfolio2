axios.get("http://localhost/portfolie/dist/api/projects.php").then(response => {
    data = response.data;
    if (response.statusText !== "OK") {
        return;
    }
    var project_list = document.getElementById("project-list");

    data.forEach(project => {
        let container = document.createElement("li");
        container.classList.add("whiteborder");
        project_list.appendChild(container);
        let header = document.createElement("h2");
        header.innerText = project.name;
        container.appendChild(header);
        let fig = document.createElement("figure");
        let img = document.createElement("img");
        let src = project.image;

        if (project.image.substring(0, 3) == "../") {
            src = project.image.slice(3);
        }
        img.src = src;
        fig.appendChild(img);
        container.appendChild(fig);

        let links = document.createElement("ul");
        links.classList.add("links");
        let link = document.createElement("li");
        let linkA = document.createElement("a");
        linkA.innerText = "Project";
        linkA.href = project.link;
        link.appendChild(linkA);
        links.appendChild(link);

        let github = document.createElement("li");
        let githubA = document.createElement("a");
        githubA.innerText = "github";
        githubA.href = project.github_link;
        github.appendChild(githubA);
        links.appendChild(github);
        container.appendChild(links);

        let discription = document.createElement("p");
        discription.innerText = project.description;
        container.appendChild(discription);

        let tools = document.createElement("ul");
        tools.classList.add("tools");

        //loop tools
        project.tools.forEach(tool => {
            let toolElem = document.createElement("li");
            let toolimage = document.createElement("i");
            toolimage.classList.add("fab");
            toolimage.classList.add("fa-2x");

            if (tool == "css3") {
                tool = "css3-alt";
            }
            toolimage.classList.add("fa-" + tool);
            toolElem.appendChild(toolimage);
            tools.appendChild(toolElem);
        });
        container.appendChild(tools);

        project_list.appendChild(container);
    });
});
