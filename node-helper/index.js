const fs = require('fs');
const axios = require('axios');
const API_ENDPOINT = 'https://fr.dofus.dofapi.fr'
const PRIVATE_API_ENDPOINT = 'http://127.0.0.1:8000'

/**
 * Fetch api data
 *
 * @return {Promise<void>}
 */
async function getApiData() {
    let result = [];
    const { data } = await axios.get(`${API_ENDPOINT}/monsters`)
    //const archmonsters = data.filter(monster => monster.type === 'Archi-monstres')

    for (const monster of data) {
        result.push(formatDataToApiModel(monster));
    }

    const seederResponse = await axios.post(`${PRIVATE_API_ENDPOINT}/api/seeder/monster`, {
        data_monster: result
    })
    console.log(seederResponse)
}

/**
 * Format json data to model format for api
 * @param data
 * @return {{pv_max: number | ((...values: number[]) => number) | string, res_air: number | ((...values: number[]) => number) | string, type, infos_url: string, pa: *, pv_min: number | ((...values: number[]) => number) | string, img_url: *, res_feu: number | ((...values: number[]) => number) | string, name: string, res_eau: number | ((...values: number[]) => number) | string, pm: *, ankama_id: *, res_terre: number | ((...values: number[]) => number) | string}}
 */
function formatDataToApiModel(data) {
    return {
        name: data.name || '',
        ankama_id: data.ankamaId,
        type: data.type,
        img_url: data.imgUrl,
        infos_url: data.url,
        pv_min: data.statistics[0].PV.min,
        pv_max: data.statistics[0].PV.max,
        pa: data.statistics[1].PA.min,
        pm: data.statistics[2].PM.min,
        res_terre: data.resistances[0].Terre.min,
        res_air: data.resistances[1].Air.min,
        res_feu: data.resistances[2].Feu.min,
        res_eau: data.resistances[3].Eau.min,
    }
}

getApiData()
.then( _ => {
    console.log('finished')
})