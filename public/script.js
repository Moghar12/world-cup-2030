async function fetchPoints() {
  let points_wrapper = document.querySelector('.points-container');
  let loader = document.querySelector('.loader');
  let url = 'https://world-cup.codsfli.com/points.php';
  let data = await fetch(url);
  if (data.ok) {
    setTimeout(async () => {
      loader.remove();
      let response = await data.json();
      response.map((groups) => {
        let sor = groups.teams.sort((a, b) => {
          return a.position - b.position;
        });
        points_wrapper.innerHTML += `
                <div class="points-table">
  <h1 class="group-heading">${groups.group}</h1>
  <table>
    <thead>
      <tr>
        <th>Team</th>
        <th>MP</th>
        <th>L</th>
        <th>D</th>
        <th>W</th>
        <th>Pts</th>
      </tr>
    </thead>
    <tbody>
      ${sor
            .map(
              (team) => `
      <tr>
        <td>
          <div class="d-a">
            <img
              src="${team.flag}"
              alt="${team.Team}"
              class="team-flag"
            />
            <span>${team.flag
                  .split('https://world-cup.codsfli.com/flag/')
                  .join('')
                  .split('.png')
                  .join('')}</span>
          </div>
        </td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
      </tr>
      `
            )
            .join('')}
    </tbody>
  </table>
</div>
                `;
      });
    }, 1000);
  }
}
fetchPoints();


